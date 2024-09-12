<?php declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Product",
 *     type="object",
 *     @OA\Property(property="id", type="integer", description="Product ID"),
 *     @OA\Property(property="name", type="string", description="Product name"),
 *     @OA\Property(property="price", type="number", format="float", description="Product price"),
 *     @OA\Property(property="description", type="string", description="Product description")
 * )
 */

/**
 * @OA\Get(
 *     path="/products",
 *     summary="Get all products",
 *     tags={"Products"},
 *     @OA\Response(
 *         response=200,
 *         description="List of products",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Product")
 *         )
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Internal server error"
 *     )
 * )
 */

class ProductController extends Controller
{
    public function index()
    {
        try {
            $products = Product::all();
            return $this->responseSuccess($products, 'Products fetched successfully');
        } catch (\Exception $e) {
            return $this->responseError('Failed to fetch products', $e->getMessage());
        }
    }

    /**
     * @OA\Post(
     *     path="/products",
     *     summary="Create a new product",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'price' => 'required|numeric',
                'description' => 'required|string',
            ]);

            $product = new Product();
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();

            return $this->responseSuccess($product, 'Product created successfully', 201);
        } catch (\Exception $e) {
            return $this->responseError('Failed to create product', $e->getMessage());
        }
    }

    /**
     * @OA\Get(
     *     path="/products/{id}",
     *     summary="Show a single product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product fetched successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return $this->responseSuccess($product, 'Product fetched successfully');
        } catch (\Exception $e) {
            return $this->responseError('Failed to fetch product', $e->getMessage());
        }
    }

    /**
     * @OA\Put(
     *     path="/products/{id}",
     *     summary="Update an existing product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated successfully",
     *         @OA\JsonContent(ref="#/components/schemas/Product")
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Invalid input"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        try {
            $validatedData = $request->validate([
                'name' => 'string|max:255',
                'price' => 'numeric',
                'description' => 'string',
            ]);

            $product = Product::findOrFail($id);
            $product->name = $request->name;
            $product->price = $request->price;
            $product->description = $request->description;
            $product->save();

            return $this->responseSuccess($product, 'Product updated successfully');
        } catch (\Exception $e) {
            return $this->responseError('Failed to update product', $e->getMessage());
        }
    }

    /**
     * @OA\Delete(
     *     path="/products/{id}",
     *     summary="Delete a product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Product deleted successfully"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal server error"
     *     )
     * )
     */
    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return $this->responseSuccess(null, 'Product deleted successfully');
        } catch (\Exception $e) {
            return $this->responseError('Failed to delete product', $e->getMessage());
        }
    }
}
