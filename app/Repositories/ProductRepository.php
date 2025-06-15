<?php


namespace App\Repositories;

use App\Models\Product;

class ProductRepository implements ProductRepositoryInterface
{

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function all()
    {

        return Product::with('category', 'supplier')->get();
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update(array $data, $id)
    {
        $product = $this->find($id);

        $product->update($data);

        return $product;
    }

    public function delete($id)
    {

        $product = $this->find($id);

        return $product->delete();
    }
}
