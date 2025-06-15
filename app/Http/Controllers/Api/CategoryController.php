<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Category\CategoryPathcRequest;
use App\Http\Requests\Api\Category\CategoryPostRequest;
use App\Http\Resources\Category\CategoryCollection;
use App\Http\Resources\Category\CategoryResource;
use App\Service\CategoryService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    function __construct(private CategoryService $categoryService) {}

    public function index()
    {
        $categories = $this->categoryService->getAll();
        return new CategoryCollection($categories);
    }

    public function show($id)
    {

        try {
            $findCategory = $this->categoryService->findById($id);

            return new CategoryResource($findCategory);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Category not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(CategoryPostRequest $request)
    {
        try {
            $create = $this->categoryService->create($request->validated());
            return response()->json(['message' => 'Category created successfully', 'data' => new CategoryResource($create)], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(CategoryPathcRequest $request, $id)
    {
        try {

            $update = $this->categoryService->update($request->validated(), $id);

            return response()->json(['message' => 'Category updated successfully', 'data' => new CategoryResource($update)], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Category not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {

        try {
            $delete = $this->categoryService->delete($id);

            return response()->json(['message' => 'Category deleted successfully'], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Category not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
