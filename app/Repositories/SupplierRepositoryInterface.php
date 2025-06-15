<?php

namespace App\Repositories;

interface SupplierRepositoryInterface
{

    public function find($id);
    public function all();
    public function create(array $data);
    public function update(array $data, $id);
    public function delete($id);
}
