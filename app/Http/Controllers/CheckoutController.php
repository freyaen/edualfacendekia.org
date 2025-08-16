<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index(Request $request)
    {
        $user = Auth::user();
        
        // Ambil item yang dipilih dari session
        $selectedItems = session('selected_items', []);
        
        // Jika tidak ada item yang dipilih, ambil semua item di keranjang
        if(empty($selectedItems)) {
            $cart = Cart::with(['details.product'])->where('user_uuid', $user->uuid)->first();
            if ($cart) {
                $selectedItems = $cart->details->pluck('uuid')->toArray();
            }
        }

        if(empty($selectedItems)) {
            return redirect()->route('cart')->with('error', 'Tidak ada item yang dipilih');
        }

        // Ambil item yang dipilih dengan detail produk
        $selectedDetails = CartDetail::with('product.store')
            ->whereIn('uuid', $selectedItems)
            ->get();
            
        // Kelompokkan berdasarkan toko
        $stores = $selectedDetails->groupBy(function($item) {
            return $item->product->store->uuid;
        });

        return view('pages.checkout', compact('stores', 'selectedItems'));
    }

    public function process(Request $request)
    {
        $user = Auth::user();
        $selectedItems = $request->input('selected_items', []);
        
        if(empty($selectedItems)) {
            return redirect()->route('cart')->with('error', 'Tidak ada item yang dipilih');
        }

        // Simpan selected_items di session untuk halaman checkout
        session(['selected_items' => $selectedItems]);

        // Ambil detail item yang dipilih
        $selectedDetails = CartDetail::with('product.store')
            ->whereIn('uuid', $selectedItems)
            ->get();
            
        // Kelompokkan berdasarkan toko
        $stores = $selectedDetails->groupBy(function($item) {
            return $item->product->store->uuid;
        });

        // Buat order untuk setiap toko
        $orders = [];
        
        DB::transaction(function() use ($user, $stores, &$orders) {
            foreach($stores as $storeId => $items) {
                $store = $items->first()->product->store;
                
                // Hitung total untuk toko ini
                $subtotal = $items->sum(function($item) {
                    return $item->product->price * $item->qty;
                });
                
                $shipping = 10000; // Ongkir per toko
                $total = $subtotal + $shipping;

                // Generate invoice number
                $currentYear = date('Y');
                $currentMonth = date('m');
                $currentDay = date('d');
                $orderCount = Order::whereYear('created_at', $currentYear)->count() + 1;
                $invoiceNumber = sprintf('INV/%03d/%s/%s/%s', 
                    $orderCount,
                    $currentDay,
                    $currentMonth,
                    $currentYear
                );

                // Buat order
                $order = Order::create([
                    'user_uuid' => $user->uuid,
                    'store_uuid' => $store->uuid,
                    'status' => 'belum dibayar',
                    'total_payment' => $total,
                    'number' => $invoiceNumber,
                    'invoice' => null,
                ]);

                // Buat order details
                foreach($items as $item) {
                    OrderDetail::create([
                        'order_uuid' => $order->uuid,
                        'product_uuid' => $item->product->uuid,
                        'qty' => $item->qty,
                        'price' => $item->product->price,
                        'subtotal' => $item->product->price * $item->qty,
                    ]);
                    
                    // Hapus item dari keranjang
                    $item->delete();
                }
                
                $orders[] = $order;
            }
        });

        // Hapus session selected_items
        session()->forget('selected_items');

        return redirect()->route('orders')
            ->with('success', 'Pesanan berhasil dibuat. Silakan lakukan pembayaran.')
            ->with('orders', $orders);
    }

    public function show($orderUuid)
    {
        $order = Order::with(['details.product', 'user'])
            ->where('uuid', $orderUuid)
            ->firstOrFail();

        return view('orders.show', compact('order'));
    }
}