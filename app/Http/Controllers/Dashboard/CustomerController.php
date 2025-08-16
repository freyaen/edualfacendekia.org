<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index()
    {
        $data['customers'] = User::where('role', 'customer')
            ->with('store') // Eager load the store relationship
            ->latest()
            ->paginate(5);
            
        return view('dashboard.pages.customers.index', compact('data'));
    }


    public function edit($uuid)
    {
        $customer = User::where('uuid', $uuid)
            ->where('role', 'customer')
            ->firstOrFail();
            
        $data['stores'] = Store::all();
        return view('dashboard.pages.customers.edit', compact('customer', 'data'));
    }

    public function update(Request $request, $uuid)
    {
        $customer = User::where('uuid', $uuid)
            ->where('role', 'customer')
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique('users')->ignore($customer->uuid, 'uuid')
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

        $customer->update($updateData);

        return redirect()->route('customers')->with('success', 'Admin toko berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $customer = User::where('uuid', $uuid)
            ->where('role', 'customer')
            ->firstOrFail();
            
        $customer->delete();

        return redirect()->route('customers')->with('success', 'Admin toko berhasil dihapus.');
    }
}