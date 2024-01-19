<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function page(int $id = null): View|Application|Factory|RedirectResponse
    {
        if ($id !== null) {
            $product = Product::query()->find($id);

            if ($product !== null) {
                return view('product.index', ['product' => $product]);
            } else {
                return view('404', ["message" => "Увы, такой страницы не существует..."]);
            }
        } else {
            return redirect()->back();
        }
    }
}
