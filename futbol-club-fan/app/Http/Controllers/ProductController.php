<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function indexPage()
    {
        $query = request('q');
        $brands = request('brands', []);
        $categories = request('categories', []);
        $minPrice = request('min_price');
        $maxPrice = request('max_price');

        $productsQuery = Product::query();

        if ($query) {
            $productsQuery->whereRaw('LOWER(name) LIKE ?', ["%" . strtolower($query) . "%"]);
        }

        if (!empty($brands)) {
            $productsQuery->whereIn('accessory', $brands);
        }

        if (!empty($categories)) {
            $productsQuery->whereIn('category', $categories);
        }


        if ($minPrice !== null && is_numeric($minPrice)) {
            $productsQuery->where('price', '>=', $minPrice);
        }

        if ($maxPrice !== null && is_numeric($maxPrice)) {
            $productsQuery->where('price', '<=', $maxPrice);
        }

        $products = $productsQuery->paginate(8)->appends([
            'q' => $query,
            'brands' => $brands,
            'categories' => $categories,
            'min_price' => $minPrice,
            'max_price' => $maxPrice,
        ]);

        return view('products.index', compact('products'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.detail', compact('product'));
    }
}
