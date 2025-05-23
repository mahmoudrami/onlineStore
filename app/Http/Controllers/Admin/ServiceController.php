<?php

namespace App\Http\Controllers\Admin;

use App\Models\Service;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
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
        $services = Service::latest('id')->paginate(10);

        return view('admins.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.services.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ServiceRequest $request)
    {
        $service = new Service();


        foreach ($this->locales as  $locale) {
            $service->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        $service->image = uploadImage($request->file('image'), 'services');

        $service->save();

        flash()->success('Service Created Successfully');
        return redirect()->route('admin.service.index');
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
    public function edit(Service $service)
    {
        return view('admins.services.edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ServiceRequest $request, Service $service)
    {

        foreach ($this->locales as  $locale) {
            $service->translateOrNew($locale)->name = $request->get('name_' . $locale);
        }

        if ($request->hasFile('image')) {
            deleteImage($service->image, 'services');
            $service->image = uploadImage($request->file('image'), 'services');
        }

        $service->save();

        flash()->success('Service Updated Successfully');
        return redirect()->route('admin.service.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        flash()->success('Service Deleted Successfully');
        return redirect()->route('admin.service.index');
    }
}
