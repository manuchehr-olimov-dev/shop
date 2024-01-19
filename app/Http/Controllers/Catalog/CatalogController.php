<?php

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\CatalogFiltersRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;

class CatalogController extends Controller
{
    protected int $productsPerPage = 10;

    public function page(? Category $category, CatalogFiltersRequest $request): View|Application
    {
        $categories = Category::query()
            ->select(['id', 'title'])
            ->limit(5)
            ->get();

        $brands = Brand::query()
            ->select(['id', 'slug', 'title'])
            ->has('products')
            ->get();

        $products = Product::query()
            ->select(['id', 'slug', 'title', 'thumbnail', 'price'])
            ->filtered($request)
            ->paginate($this->productsPerPage);


        return view('catalog.index', [
            "products" => $products,
            "brands" => $brands,
            "categories" => $categories,
            "category" => $category
        ]);
    }

}
