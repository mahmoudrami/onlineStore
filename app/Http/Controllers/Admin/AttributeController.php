<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\AttributeRequest;

class AttributeController extends Controller
{
    private $locales;
    public function __construct()
    {
        $this->locales = Language::all()->pluck('code')->toArray();
        view()->share(['locales' => $this->locales]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $routes = Route::getRoutes();

        $resourceNames = collect($routes)->filter(function ($route) {
            return $route->getName() && str_starts_with($route->getName(), 'admin.') && str_contains($route->getName(), '.index');
        })->map(function ($route) {
            // مثال: admin.products.index => products
            $name = $route->getName(); // admin.products.index
            return explode('.', $name)[1]; // products
        })->unique()->values();


        // dd('contact');
        // dd($this->locales);
        $attributes = Attribute::latest('id')->paginate(10);

        return view('admins.attributes.index', compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.attributes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AttributeRequest $request)
    {
        $attribute = new Attribute();


        foreach ($this->locales as  $locale) {
            $attribute->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $attribute->is_multiple = $request->is_multiple;


        $attribute->save();

        flash()->success('Attribute Created Successfully');
        return redirect()->route('admin.attribute.index');
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
    public function edit(Attribute $attribute)
    {
        return view('admins.attributes.edit', compact('attribute'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AttributeRequest $request, Attribute $attribute)
    {

        foreach ($this->locales as  $locale) {
            $attribute->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $attribute->save();

        flash()->success('Attribute Updated Successfully');
        return redirect()->route('admin.attribute.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Attribute $attribute)
    {
        $attribute->delete();
        flash()->success('Attribute Deleted Successfully');
        return redirect()->route('admin.attribute.index');
    }
}
