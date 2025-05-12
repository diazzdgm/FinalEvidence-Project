<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the products.
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index()
    {
        return Product::all();
    }

    /**
     * Display the specified product.
     *
     * @param  \App\Models\Product  $product
     * @return \App\Models\Product
     */
    public function show(Product $product)
    {
        return $product;
    }

    /**
     * Store a newly created product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\Product
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'price' => 'required|numeric|min:0',
                'category_id' => 'required|exists:categories,id',
            ]);

            $product = Product::create($request->all());

            return $product;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error creating product'], 500);
        }
    }

    /**
     * Update the specified product in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \App\Models\Product
     */
    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'string|max:255',
                'description' => 'nullable|string',
                'price' => 'numeric|min:0',
                'category_id' => 'exists:categories,id',
            ]);

            $product->update($request->all());

            return $product;
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating product'], 500);
        }
    }

    /**
     * Remove the specified product from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return response()->json(null, 204);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error deleting product'], 500);
        }
    }
}
