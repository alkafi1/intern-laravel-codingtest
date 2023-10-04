<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function index(Request $request)
    {

        $query = Product::query();

        // if ($request->filled('search')) {
        //     $query->where('name', 'like', '%' . $request->input('search') . '%');
        // }

        $products = $query->get();

        return view('product.view', compact('products'));
    }

    public function searchProduct(Request $request)
    {
        // $data = $request->all();
        // return $products = Product::where(function ($q) use ($data) {
        //     if (!empty($data['q']) && $data['q'] != '' && $data['q'] != 'undefined') {
        //         $q->where(function ($q) use ($data) {
        //             $q->where('name', 'like', '%' . $data['q'] . '%');
        //             // $q->orWhere('description', 'like', '%' . $data['q'] . '%');
        //         });
        //     }
        // })->get();
        $query = Product::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%');
            $query->orWhere('description', 'like', '%' . $request->search . '%');
        }

        $products = $query->get();

        return view('product.view', compact('products'));
    }
}
