<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        $data['admins'] = User::where('role', 'admin')
            ->with('store') // Eager load the store relationship
            ->latest()
            ->paginate(5);
            
        return view('dashboard.pages.admins.index', compact('data'));
    }

    public function create()
    {
        $data['stores'] = Store::all();
        return view('dashboard.pages.admins.create', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'store_uuid' => 'required|exists:stores,uuid',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin',
            'store_uuid' => $request->store_uuid,
        ]);

        return redirect()->route('admins')->with('success', 'Admin toko berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $admin = User::where('uuid', $uuid)
            ->where('role', 'admin')
            ->firstOrFail();
            
        $data['stores'] = Store::all();
        return view('dashboard.pages.admins.edit', compact('admin', 'data'));
    }

    public function update(Request $request, $uuid)
    {
        $admin = User::where('uuid', $uuid)
            ->where('role', 'admin')
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($admin->uuid, 'uuid')
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'store_uuid' => 'required|exists:stores,uuid',
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'store_uuid' => $request->store_uuid,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        $admin->update($updateData);

        return redirect()->route('admins')->with('success', 'Admin toko berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $admin = User::where('uuid', $uuid)
            ->where('role', 'admin')
            ->firstOrFail();
            
        $admin->delete();

        return redirect()->route('admins')->with('success', 'Admin toko berhasil dihapus.');
    }
}