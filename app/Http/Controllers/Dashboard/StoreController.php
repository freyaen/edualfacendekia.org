<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    public function index(){
        $data['stores'] = Store::latest()
        ->paginate(5);
        
        return view('dashboard.pages.stores.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.pages.stores.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Store::create($request->only(['name', 'city', 'address', 'latitude', 'longitude']));

        return redirect()->route('stores')->with('success', 'Toko berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $store = Store::findOrFail($uuid);
        return view('dashboard.pages.stores.edit', compact('store'));
    }

    // Simpan update data toko
    public function update(Request $request, $uuid)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:100',
            'address' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        $store = Store::findOrFail($uuid);
        $store->update($request->only(['name', 'city', 'address', 'latitude', 'longitude']));

        return redirect()->route('stores')->with('success', 'Toko berhasil diperbarui.');
    }

    // Hapus toko
    public function destroy($uuid)
    {
        $store = Store::findOrFail($uuid);
        $store->delete();

        return redirect()->route('stores')->with('success', 'Toko berhasil dihapus.');
    }

}
