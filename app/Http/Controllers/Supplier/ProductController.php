<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Image;
use App\Models\product;
use App\Models\Category;
use Illuminate\Http\Request;

use function Pest\Laravel\delete;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Language;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public $locales;
    public function __construct()
    {
        $this->locales = Language::active()->get()->pluck('code')->toArray();
        view()->share($this->locales);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::where('supplier_id', Auth::guard('supplier')->user()->id)->latest('id')->paginate(10);
        return view('suppliers.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        return view('suppliers.products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        // dd($request->all());
        // dd($request->image);
        $product = new product();

        // return $this->locales;
        foreach ($this->locales as $key => $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->supplier_id = Auth::guard('supplier')->user()->id;
        $product->save();

        $product->image()->create([
            'path' => uploadImage($request->file('image'), 'products'),
            'type' => 'main'
        ]);

        if ($request->hasFile('galleries')) {
            foreach ($request->galleries as $gallery) {
                $product->gallery()->create([
                    'path' => uploadImage($gallery, 'products'),
                    'type' => 'gallery'
                ]);
            }
        }
        flash()->success('Product Created Successfully');

        return redirect()->route('supplier.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        return view('suppliers.products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {

        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;

        if ($request->hasFile('image')) {
            if ($product->image) {
                deleteImage($product->image->path, 'products');
                $product->image->delete();
            }
            $product->image()->create([
                'path' => uploadImage($request->file('image'), 'products'),
                'type' => 'main'
            ]);
        }

        if ($request->hasFile('galleries')) {
            foreach ($request->file('galleries') as $image) {
                $product->gallery()->create([
                    'path' => uploadImage($image, 'products'),
                    'type' => 'gallery'
                ]);
            }
        }

        $product->save();

        flash()->success('Product Updated Successfully');
        return redirect()->route('supplier.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        deleteImage($product->image->path, 'products');
        foreach ($product->gallery() as $one) {

            deleteImage($one->path, 'products');
        }
        $product->delete();
        flash()->success('Product Deleted Successfully');

        return redirect()->route('supplier.product.index');
    }

    function delete_image($id)
    {
        $image =  Image::findOrFail($id);
        $image->delete();
        deleteImage($image->path, 'products');
        return response()->json([
            'status' => 200,

        ]);
    }
}
