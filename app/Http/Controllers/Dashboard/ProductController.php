<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Store;
use App\Models\ProductImage;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $productsQuery = Product::with(['store', 'images'])->latest();

        if ($user->role === 'admin') {
            $productsQuery->where('store_uuid', $user->store_uuid);
        }

        $data = [
            'user' => $user,
            'products' => $productsQuery->paginate(5),
        ];


        return view('dashboard.pages.products.index', compact('data'));
    }

    public function create()
    {
        $data['user'] = Auth::user();
        $data['stores'] = Store::all();
        $data['types'] = Type::all();
        
        return view('dashboard.pages.products.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'store_uuid' => 'required|exists:stores,uuid',
            'type_uuid' => 'required|exists:types,uuid',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'stock' => 'required|integer|min:0',
            'price' => 'required|integer|min:0',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:50000'
        ]);

        $product = Product::create([
            'uuid' => Str::uuid(),
            'store_uuid' => $request->store_uuid,
            'type_uuid' => $request->type_uuid,
            'name' => $request->name,
            'description' => $request->description,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $imageName = time() . '_' . $image->getClientOriginalName();
                $image->storeAs('products', $imageName, 'public');

                ProductImage::create([
                    'uuid' => Str::uuid(),
                    'product_uuid' => $product->uuid,
                    'name' => $imageName,
                ]);
            }
        }

        return redirect()->route('products')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $data['user'] = Auth::user();
        $product = Product::with('images')->where('uuid', $uuid)->firstOrFail();
        $data['stores'] = Store::all();
        $data['types'] = Type::all();
        
        return view('dashboard.pages.products.edit', compact('product', 'data'));
    }

    public function update(Request $request, $uuid)
{
    $product = Product::where('uuid', $uuid)->firstOrFail();

    $request->validate([
        // Your existing validation rules
        'delete_images.*' => 'nullable|exists:product_images,uuid'
    ]);

    // Handle image deletions
    if ($request->has('delete_images')) {
        $imagesToDelete = ProductImage::whereIn('uuid', $request->delete_images)
            ->where('product_uuid', $product->uuid)
            ->get();

        foreach ($imagesToDelete as $image) {
            Storage::delete('public/products/' . $image->name);
            $image->delete();
        }
    }

    // Update product data
    $product->update([
        'store_uuid' => $request->store_uuid,
        'type_uuid' => $request->type_uuid,
        'name' => $request->name,
        'description' => $request->description,
        'stock' => $request->stock,
        'price' => $request->price,
    ]);

    // Handle new image uploads
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('products', $imageName, 'public');

            ProductImage::create([
                'uuid' => Str::uuid(),
                'product_uuid' => $product->uuid,
                'name' => $imageName,
            ]);
        }
    }

    return redirect()->route('products')->with('success', 'Produk berhasil diperbarui.');
}

    public function destroy($uuid)
    {
        $product = Product::where('uuid', $uuid)->firstOrFail();
        
        // Delete associated images
        foreach ($product->images as $image) {
            Storage::delete('public/products/' . $image->name);
            $image->delete();
        }
        
        $product->delete();

        return redirect()->route('products')->with('success', 'Produk berhasil dihapus.');
    }

    public function destroyImage($uuid)
    {
        $image = ProductImage::where('uuid', $uuid)->firstOrFail();
        Storage::delete('public/products/' . $image->name);
        $image->delete();

        return back()->with('success', 'Gambar berhasil dihapus.');
    }
}