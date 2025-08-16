<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['details.product', 'user'])
            ->where('user_uuid', Auth::id())
            ->latest()
            ->paginate(10);

        return view('pages.orders.index', compact('orders'));
    }

    public function detail($orderUuid)
    {
        $order = Order::with(['details.product', 'user'])
            ->where('uuid', $orderUuid)
            ->where('user_uuid', Auth::id())
            ->firstOrFail();

        return view('pages.orders.detail', compact('order'));
    }

    public function upload(Request $request, $orderUuid)
    {
        $request->validate([
            'invoice' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);

        $order = Order::where('uuid', $orderUuid)
            ->where('user_uuid', Auth::user()->uuid)
            ->where('status', 'belum dibayar')
            ->firstOrFail();

        // Hapus file lama jika ada
        if ($order->invoice) {
            Storage::delete('public/invoices/'.$order->invoice);
        }

        // Simpan file baru
        $file = $request->file('invoice');
        $filename = 'payment_'.$order->number.'_'.time().'.'.$file->getClientOriginalExtension();
        $file->storeAs('public/invoices', $filename);

        // Update order
        $order->update([
            'invoice' => $filename,
            'status' => 'sudah dibayar'
        ]);

        return redirect()->back()->with('success', 'Bukti pembayaran berhasil diupload. Pesanan akan segera diproses.');
    }

    public function complete(Request $request, $orderUuid)
{
    $order = Order::where('uuid', $orderUuid)
        ->where('user_uuid', Auth::id())
        ->where('status', 'dikirim')
        ->firstOrFail();

    $order->update([
        'status' => 'selesai'
    ]);

    return redirect()->back()->with('success', 'Pesanan telah diselesaikan. Terima kasih atas pembelian Anda!');
}
 
}
