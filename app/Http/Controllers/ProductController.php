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
        $data = $request->all();
        // $data['search'];
        $products = Product::where(function ($q) use ($data) {
            if (!empty($data['search']) && $data['search'] != '' && $data['search'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('name', 'like', '%' . $data['search'] . '%');
                    $q->orWhere('description', 'like', '%' . $data['search'] . '%');
                });
            }
        })->get();

        return view('product.view', [
            'products' => $products,
        ]);
    }
    public function dy_searchProduct(Request $request)
    {
        $data = $request->all();
        // $data['search'];
        $products = Product::where(function ($q) use ($data) {
            if (!empty($data['search']) && $data['search'] != '' && $data['search'] != 'undefined') {
                $q->where(function ($q) use ($data) {
                    $q->where('name', 'like', '%' . $data['search'] . '%');
                    $q->orWhere('description', 'like', '%' . $data['search'] . '%');
                });
            }
        })->get();
        $html = '';
        foreach ($products as $product) {
            $html .= '
           <tr> <td class="border px-4 py-2">'.$product->name.'</td>'.
            '<td class="border px-4 py-2">'.$product->description .'</td>'.
            '<td class="border px-4 py-2">৳'.$product->price. '</td>'.
            '</tr>';
        }
        echo $html;

        // return response()->json(['products' => $html]);
    }
}
