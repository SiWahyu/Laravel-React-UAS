<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Supplier\SupplierPatchRequest;
use App\Http\Requests\Api\Supplier\SupplierPostRequest;
use App\Http\Resources\Supplier\SupplierCollection;
use App\Http\Resources\Supplier\SupplierResource;
use App\Service\SupplierSerivce;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class SupplierController extends Controller
{


    function __construct(private SupplierSerivce $supplierSerivce) {}

    public function index()
    {
        $suppliers = $this->supplierSerivce->getAll();
        return new SupplierCollection($suppliers);
    }

    public function show($id)
    {

        try {
            $findSupplier = $this->supplierSerivce->findById($id);

            return new SupplierResource($findSupplier);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Supplier not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function store(SupplierPostRequest $request)
    {
        try {
            $create = $this->supplierSerivce->create($request->validated());
            return response()->json(['message' => 'Supplier created successfully', 'data' => new SupplierResource($create)], 201);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function update(SupplierPatchRequest $request, $id)
    {
        try {

            $update = $this->supplierSerivce->update($request->validated(), $id);

            return response()->json(['message' => 'Supplier updated successfully', 'data' => new SupplierResource($update)], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Supplier not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }

    public function destroy($id)
    {

        try {
            $delete = $this->supplierSerivce->delete($id);

            return response()->json(['message' => 'Supplier deleted successfully'], 200);
        } catch (ModelNotFoundException $th) {
            return response()->json(['message' => "Supplier not found"], 404);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage()], 500);
        }
    }
}
