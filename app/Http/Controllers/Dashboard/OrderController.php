<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $ordersQuery = Order::with('user')->latest();

        if ($user->role === 'admin') {
            $ordersQuery->where('store_uuid', $user->store_uuid);
        }

        $orders = $ordersQuery->get();

        $data = [
            'orders' => $orders,
            'user' => $user,
        ];

        return view('dashboard.pages.orders.index', compact('data'));
    }


    public function show($uuid)
    {
        $order = Order::with(['user', 'details.product'])->findOrFail($uuid);
        return view('dashboard.pages.orders.show', compact('order'));
    }

    public function update(Request $request, $uuid)
    {
        DB::beginTransaction();

        $order = Order::findOrFail($uuid);
        
        $request->validate([
            'status' => 'required|in:sudah dibayar,dikemas,dikirim,selesai',
            'receipt' => 'sometimes|required|string|max:255'
        ]);
        
        $oldStatus = $order->status;
        $newStatus = $request->status;
        
        $order->status = $newStatus;
        
        if($request->filled('receipt')) {
            $order->receipt = $request->receipt;
        }
        
        $order->save();

        if ($newStatus === 'dikirim' && $oldStatus !== 'dikirim') {
            $orderDetails = $order->details;

            foreach ($orderDetails as $detail) {
                $product = $detail->product;
                if ($product) {
                    $product->stock -= $detail->qty;
                    if ($product->stock < 0) {
                        DB::rollBack();
                        return redirect()->route('orders.show', $order->uuid)
                        ->with('failed', 'Stok produk ' . $product->name . ' tidak cukup');
                    }
                    $product->save();
                }
            }
        }

        DB::commit();
        
        return redirect()->route('orders.show', $order->uuid)
            ->with('success', 'Status pesanan berhasil diperbarui');
    }
}