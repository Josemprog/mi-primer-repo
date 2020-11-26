<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $request;

        $products = Product::orderBy('id', 'ASC')
            ->brand($products->brand)
            ->name($products->name)
            ->price($products->price)
            ->paginate(10);
            
        return $products;
    }

    private function cargarArchivo($file)
    {
        $nombreArchivo = time() . "." . $file->getClientOriginalExtension();
        $file->move(storage_path('app/public/'), $nombreArchivo);

        return $nombreArchivo;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductsRequest $request)
    {
        $product = new Product($request->validated());
        if ($request->has('image')) {
            $product->image = $this->cargarArchivo($request->image);
        }
        $product->save();
        
        return response()->json([
            'res' => true,
            'message' => 'The product has been created successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Product $product, ProductsRequest $request, $id)
    {
        if ($request->has('image')) {
            Storage::disk('public')->delete($product->image);
            Storage::delete($product->image);
            $product->fill($request->validated());
            $product->image = $this->cargarArchivo($request->image);
            $product->save();
        }

        $product->update($request->validated());


        return response()->json([
            'res' => true,
            'message' => 'The product was successfully updated'
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
