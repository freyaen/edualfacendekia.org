<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function index(){
        $data['user'] = Auth::user();

        $queryTotalProducts = Product::query();
        $queryTotalOrders = Order::query();
        $queryTotalCustomers = User::where('role', 'customer');
        $queryTotalIncome = Order::where('status', '!=', 'belum dibayar');
        $queryLatestOrders = Order::latest()->limit(5);

        if ($data['user']->role == 'admin') {
            $queryTotalProducts->where('store_uuid', $data['user']->store_uuid);
            $queryTotalOrders->where('store_uuid', $data['user']->store_uuid);
            $queryTotalCustomers->where('store_uuid', $data['user']->store_uuid);
            $queryTotalIncome->where('store_uuid', $data['user']->store_uuid);
            $queryLatestOrders->where('store_uuid', $data['user']->store_uuid);
        }

        $data['totalProducts'] = $queryTotalProducts->count();
        $data['totalOrders'] = $queryTotalOrders->count();
        $data['totalCustomers'] = $queryTotalCustomers->count();
        $data['totalIncome'] = $queryTotalIncome->sum('total_payment');
        $data['latestOrders'] = $queryLatestOrders->get();

        return view('dashboard.pages.index', compact('data'));

    }
}
