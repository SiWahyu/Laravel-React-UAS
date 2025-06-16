<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        return response()->json([
            'product' => [
                'name' => 'Product',
                'total' => Product::count()
            ],
            'category' => [
                'name' => 'Category',
                'total' => Category::count()
            ],
            'supplier' => [
                'name' => 'Supplier',
                'total' => Supplier::count()
            ],
        ], 200);
    }
}
