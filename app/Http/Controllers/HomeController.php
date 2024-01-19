<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::query()
            ->limit(10)
            ->get();

        $brands = Brand::query()
            ->limit(3)
            ->get();

        $products = Product::query()
            ->limit(6)
            ->get();

        return view('index', [
            "products" => $products,
            "brands" => $brands,
            "categories" => $categories
        ]);
    }
}
