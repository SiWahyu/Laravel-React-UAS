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
            'count_products' => Product::count(),
            'count_categories' => Category::count(),
            'count_suppliers' => Supplier::count(),
        ], 200);
    }
}
