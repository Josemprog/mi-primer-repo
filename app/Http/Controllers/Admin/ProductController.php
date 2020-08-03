<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request): \Illuminate\View\View
    {
        $brand = $request->get('brand');
        $name = $request->get('name');
        $email = $request->get('email');
        $unit_price = $request->get('unit_price');

        $products = Product::orderBy('id', 'ASC')
            ->brand($brand)
            ->name($name)
            ->email($email)
            ->unit_price($unit_price)
            ->paginate(9);

        return view('admin.products.index')->with('products', $products);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function panel(Request $request): \Illuminate\View\View
    {
        $brand = $request->get('brand');
        $name = $request->get('name');
        $email = $request->get('email');
        $unit_price = $request->get('unit_price');
        $enabled = $request->get('enabled');

        $products = Product::orderBy('id', 'ASC')
            ->brand($brand)
            ->name($name)
            ->email($email)
            ->unit_price($unit_price)
            ->enabled($enabled)
            ->paginate(4);

        return view('admin.products.panel')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create(): \Illuminate\View\View
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request): \Illuminate\Http\RedirectResponse
    {
        $product = Product::create(request()->validate([
            'brand' => 'required|string',
            'name' => 'required|string',
            'unit_price' => 'required|integer',
            'quantity' => 'required|integer',
            'description' => 'required|min:3',
            'image' => 'required'
        ]));

        $product->image = $request->file('image')->store('images', 'public');
        $product->save();
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function show(Product $product): \Illuminate\View\View
    {
        return view('admin.products.show')->with('product', $product);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit(Product $product): \Illuminate\View\View
    {
        return view('admin.products.edit')->with('product', $product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Product $product, Request $request): \Illuminate\Http\RedirectResponse
    {
        if ($request->hasFile('image')) {
            $product->update(array_filter(request()->validate([
                'brand' => 'required|string',
                'name' => 'required|string',
                'unit_price' => 'required|integer',
                'quantity' => 'required|integer',
                'description' => 'required|min:3',
                'image' => 'required',
            ])));

            $product->image = $request->file('image')->store('images', 'public');
            $product->save();
            return redirect()->route('products.index');
        } else {
            $product->update(array_filter(request()->validate([
                'brand' => 'required|string',
                'name' => 'required|string',
                'unit_price' => 'required|integer',
                'quantity' => 'required|integer',
                'description' => 'required|min:3',
                'image' => 'nullable',
            ])));
            return redirect()->route('products.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Product $product): \Illuminate\Http\RedirectResponse
    {
        $product->delete();

        return redirect()->route('products.index');
    }
}
