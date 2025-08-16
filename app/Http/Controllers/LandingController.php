<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Store;
use App\Models\Type;


class LandingController extends Controller
{
    public function index()
    {
        $data = [
            'store_uuid' => request('store_uuid'),
            'type_uuid' => request('type_uuid'),
            'keyword' => request('keyword'),
        ];

        $data['stores'] = Store::latest()->get();
        
        // Build product query
        $productQuery = Product::query();
        
        if($data['store_uuid']) {
            $productQuery->where('store_uuid', $data['store_uuid']);
        }
        
        if($data['type_uuid']) {
            $productQuery->where('type_uuid', $data['type_uuid']);
        }
        
        if($data['keyword']) {
            $productQuery->where('name', 'like', '%'.$data['keyword'].'%');
        }

        $data['products'] = $productQuery->get();
        $data['productsLatest'] = $productQuery->latest()->get()
        ->take(3);
        $data['types'] = Type::latest()->get();

        return view('pages.index', compact('data'));
    }
}
