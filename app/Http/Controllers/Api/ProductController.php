<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\ProductCollection;
use App\Http\Resources\Product as ProductResources;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(): JsonResponse
    {
        return response()->json(
            new ProductCollection(
                $this->product->orderBy('id', 'desc')->get()
            )
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\ProductsRequest  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(ProductsRequest $request): JsonResponse
    {
        $product = $this->product->create($request->validated());
        $product->image = $request->file('image')->store('images', 'public');
        $product->save();

        return response()->json(new ProductResources($product), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Product $product): JsonResponse
    {
        return response()->json(new ProductResources($product), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return @return \Illuminate\Http\JsonResponse
     */
    public function update(ProductsRequest $request, Product $product): JsonResponse
    {
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($product->image);
            Storage::delete($product->image);

            $product->fill($request->validated());
            $product->image = $request->file('image')->store('images');
            $product->save();
        } else {
            $product->update($request->validated());
        }

        return response()->json(new ProductResources($product));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(null, 204);
    }
}
