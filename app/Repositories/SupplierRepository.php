<?php


namespace App\Repositories;

use App\Models\Supplier;

class SupplierRepository implements SupplierRepositoryInterface
{

    public function find($id)
    {
        return Supplier::findOrFail($id);
    }

    public function all()
    {

        return Supplier::all();
    }

    public function create(array $data)
    {
        return Supplier::create($data);
    }

    public function update(array $data, $id)
    {
        $category = $this->find($id);

        $category->update($data);

        return $category;
    }

    public function delete($id)
    {

        $category = $this->find($id);

        return $category->delete();
    }
}
