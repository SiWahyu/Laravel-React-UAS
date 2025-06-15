<?php


namespace App\Repositories;

use App\Models\Category;

class CategoryRepository implements CategoryRepositoryInterface
{

    public function find($id)
    {
        return Category::findOrFail($id);
    }

    public function all()
    {

        return Category::all();
    }

    public function create(array $data)
    {
        return Category::create($data);
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
