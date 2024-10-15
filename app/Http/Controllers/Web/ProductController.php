<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function search(Request $request)
    {
        $search = $request->get('search');
        $products = [];
        if (!empty($search)) {
            $products = Product
                ::where(function ($query) use ($search) {
                    $query->orwhere('name', 'like', "%$search%");
                    $query->orwhere('slug', 'like', "%$search%");
                })
                ->paginate(5);
        }

        return view('product.index', compact('products'));
    }
}
