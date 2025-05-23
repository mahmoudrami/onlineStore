<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
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
        $categories = Category::latest('id')->paginate(10);

        return view('admins.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {
        $category = new Category();


        foreach ($this->locales as  $locale) {
            $category->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $category->image = uploadImage($request->file('image'), 'categories');

        $category->save();

        flash()->success('Category Created Successfully');
        return redirect()->route('admin.category.index');
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
    public function edit(Category $category)
    {
        return view('admins.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        foreach ($this->locales as  $locale) {
            $category->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        if ($request->hasFile('image')) {
            deleteImage($category->image, 'categories');
            $category->image = uploadImage($request->file('image'), 'categories');
        }

        $category->save();

        flash()->success('Category Updated Successfully');
        return redirect()->route('admin.category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        flash()->success('Category Deleted Successfully');
        return redirect()->route('admin.category.index');
    }
}
