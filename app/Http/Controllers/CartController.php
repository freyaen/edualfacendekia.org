<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $cart = Cart::with(['details.product.store'])->where('user_uuid', $user->uuid)->first();

        return view('pages.cart', compact('cart'));
    }

    public function addTo(Request $request, $productUuid)
    {
        
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $user = Auth::user();
        $product = Product::findOrFail($productUuid);

        // Get or create user's cart
        $cart = Cart::firstOrCreate(
            ['user_uuid' => $user->uuid],
            ['user_uuid' => $user->uuid]
        );

        // Check if product already in cart
        $cartDetail = $cart->details()->where('product_uuid', $productUuid)->first();

        if ($cartDetail) {
            // Update quantity if product exists
            $cartDetail->update([
                'qty' => $cartDetail->qty + $request->qty
            ]);
        } else {
            // Add new item to cart
            CartDetail::create([
                'cart_uuid' => $cart->uuid,
                'product_uuid' => $productUuid,
                'qty' => $request->qty
            ]);
        }

        return redirect()->route('cart')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    public function update(Request $request, $cartDetailUuid)
    {
        $request->validate([
            'qty' => 'required|numeric|min:1'
        ]);

        $cartDetail = CartDetail::findOrFail($cartDetailUuid);
        $cartDetail->update(['qty' => $request->qty]);

        return redirect()->route('cart')->with('success', 'Keranjang berhasil diperbarui');
    }

    public function removeFrom($cartDetailUuid)
    {
        $cartDetail = CartDetail::findOrFail($cartDetailUuid);
        $cartDetail->delete();

        return redirect()->route('cart')->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}