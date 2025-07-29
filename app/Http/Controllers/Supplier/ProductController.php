<?php

namespace App\Http\Controllers\Supplier;

use App\Models\Image;
use App\Models\product;
use App\Models\Category;
use App\Models\Language;

use App\Models\Supplier;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use function Pest\Laravel\delete;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductAttributeValue;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public $locales;
    public function __construct()
    {
        $this->locales = Language::active()->get()->pluck('code')->toArray();
        // dd($this->locales);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest('id')->paginate(10);
        return view('suppliers.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->get();
        $suppliers = Supplier::active()->select('id', 'name')->get();
        $attributes = Attribute::active()->get();
        return view('suppliers.products.create', compact('categories', 'suppliers', 'attributes'));
    }

    /**
     * Store a newly created resource in storage.
     */

    private function findOrCreateAttributeValue($attributeId, $value, $locale)
    {
        $attributeValue = AttributeValue::whereTranslation('value', $value, $locale)->first();
        if (!$attributeValue) {
            $attributeValue = new AttributeValue();
            $attributeValue->translateOrNew($locale)->value = $value;
            $attributeValue->attribute_id = $attributeId;
            $attributeValue->save();
        }

        return $attributeValue;
    }

    public function store(ProductRequest $request)
    {

        $product = new product();

        foreach ($this->locales as $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
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

        foreach ($request->attributeValue as $attributeName => $item) {
            // dd($request->$attributeName);
            if ($request->$attributeName) {
                $attribute = Attribute::findOrFail($request->$attributeName);
                foreach ($this->locales as $locale) {
                    foreach ($item[$locale] as $value) {
                        try {
                            DB::beginTransaction();
                            $attributeValue = $this->findOrCreateAttributeValue($attribute->id, $value, $locale);
                            $product->attributeValues()->attach($attributeValue->id);
                            DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            throw new Exception($e->getMessage());
                        }
                    }
                }
            }
        }
        flash()->success('Product Created Successfully');

        return redirect()->route('supplier.product.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::active()->get();
        $suppliers = Supplier::active()->select('id', 'name')->get();
        $attributes = Attribute::active()->get();


        $attributesProduct = [];
        foreach ($this->locales as $locale) {
            foreach ($attributes as $key => $attribute) {
                $values = $product->attributeValues->filter(function ($val) use ($attribute) {;
                    return $val->attribute_id == $attribute->id;
                });
                $valueWithTrans = [];
                foreach ($values as $one) {
                    if (!empty($one->translate($locale)->value)) {
                        $valueWithTrans[] = $one->translate($locale)->value;
                    }
                }
                if (!empty($values)) {
                    $attributesProduct[$attribute->name][$locale] = $valueWithTrans;
                }
            }
        }
        return view('suppliers.products.edit', compact('product', 'categories', 'suppliers', 'attributes', 'attributesProduct'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductRequest $request, Product $product)
    {

        // dd($request->attributeValue);


        foreach ($this->locales as $locale) {
            $product->translateOrNew($locale)->name = $request->get('name_' . $locale);
            $product->translateOrNew($locale)->description = $request->get('description_' . $locale);
        }
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->category_id = $request->category_id;
        $product->supplier_id = Auth::guard('supplier')->user()->id;

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


        $product->attributeValues()->detach();
        foreach ($request->attributeValue as $attributeName => $item) {
            if ($request->$attributeName) {
                $attribute = Attribute::findOrFail($request->$attributeName);
                foreach ($this->locales as $locale) {
                    foreach ($item[$locale] as $value) {
                        try {
                            DB::beginTransaction();
                            $attributeValue = $this->findOrCreateAttributeValue($attribute->id, $value, $locale);
                            // dd($attributeValue->value);
                            // problem here
                            $product->attributeValues()->attach($attributeValue->id);
                            DB::commit();
                        } catch (Exception $e) {
                            DB::rollBack();
                            throw new Exception($e->getMessage());
                        }
                    }
                }
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
        try {
            deleteImage($product->image->path, 'products');
        } catch (\Throwable $th) {
        }
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