<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shipping;
use App\Models\Language;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\ShippingRequest;

class ShippingController extends Controller
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

        $shippings = Shipping::latest('id')->paginate(10);
        return view('admins.shippings.index', compact('shippings'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admins.shippings.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShippingRequest $request)
    {
        Shipping::create($request->all());
        flash()->success('Shipping Created Successfully');
        return redirect()->route('admin.shipping.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Shipping $shipping)
    {
        return view('admins.shippings.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ShippingRequest $request, Shipping $shipping)
    {

        $shipping->update($request->all());

        flash()->success('Shipping Updated Successfully');
        return redirect()->route('admin.shipping.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Shipping $shipping)
    {
        $shipping->delete();
        flash()->success('Shipping Deleted Successfully');
        return redirect()->route('admin.shipping.index');
    }
}