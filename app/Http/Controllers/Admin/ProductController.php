<?php

namespace App\Http\Controllers\Admin;

use App\Models\Image;
use App\Models\product;
use Illuminate\Http\Request;
use function Pest\Laravel\delete;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(10);
        return view('admins.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd($request->image);
        $product = new product();
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
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

        return redirect()->route('admin.product.index');
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
        return view('admins.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {


        // dd($product->image->path);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->quantity = $request->quantity;

        if ($request->hasFile('image')) {
            deleteImage($product->image->path, 'products');
            $product->image->delete();
            $product->image()->create([
                'path' => uploadImage($request->file('image'), 'products'),
                'type' => 'main'
            ]);
        }

        if ($request->hasFile('galleries')) {
            foreach ($product->gallery as $gallery) {
                deleteImage($gallery->path, 'products');
                $gallery->delete();
            }
            foreach ($request->file('galleries') as $one) {
                $product->gallery()->create([
                    'path' => uploadImage($one, 'products'),
                    'type' => 'gallery'
                ]);
            }
        }



        flash()->success('Product Updated Successfully');

        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        deleteImage($product->image()->path, 'products');
        foreach ($product->gallery() as $one) {

            deleteImage($one->path, 'products');
        }
        $product->delete();
        flash()->success('Product Deleted Successfully');

        return redirect()->route('admin.product.index');
    }

    function delete_image($id)
    {
        $image =  Image::findOrFail($id);
        $image->delete();
        return response()->json([
            'status' => 200,

        ]);
    }
}
