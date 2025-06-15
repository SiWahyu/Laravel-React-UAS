<?php

namespace App\Service;

use App\Repositories\SupplierRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class SupplierSerivce implements SupplierSerivceInterface
{

    public function __construct(private SupplierRepository $repository) {}

    public function findById($id)
    {
        try {
            return $this->repository->find($id);
        } catch (ModelNotFoundException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function getAll()
    {
        return $this->repository->all();
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(array $data, $id)
    {
        try {
            return $this->repository->update($data, $id);
        } catch (ModelNotFoundException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function delete($id)
    {
        try {
            return $this->repository->delete($id);
        } catch (ModelNotFoundException $th) {
            throw $th;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
