<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Product\ProductPatchRequest;
use App\Http\Requests\Api\Product\ProductPostRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Service\ProductService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class ProductController extends Controller
{


    function __construct(private ProductService $productService) {}

    public function index()
    {
        $categories = $this->productService->getAll();
        return new ProductCollection($categories);
    }

    public function show($id)
    {

        try {
            $findProduct = $this->productService->findById($id);

            return new ProductResource($findProduct);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Product not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(ProductPostRequest $request)
    {
        try {
            $create = $this->productService->create($request->validated());
            return response()->json(['message' => 'Product created successfully', 'data' => new ProductResource($create)], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(ProductPatchRequest $request, $id)
    {
        try {

            $update = $this->productService->update($request->validated(), $id);

            return response()->json(['message' => 'Product updated successfully', 'data' => new ProductResource($update)], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Product not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {

        try {
            $delete = $this->productService->delete($id);

            return response()->json(['message' => 'Product deleted successfully'], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Product not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
