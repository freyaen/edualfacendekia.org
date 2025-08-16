<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class TypeController extends Controller
{
    public function index()
    {
        $data['types'] = Type::latest()
            ->paginate(5);
            
        return view('dashboard.pages.types.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.pages.types.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Type::create([
            'name' => $request->name,
        ]);

        return redirect()->route('types')->with('success', 'Jenis berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $type = Type::where('uuid', $uuid)
            ->firstOrFail();
            
        return view('dashboard.pages.types.edit', compact('type'));
    }

    public function update(Request $request, $uuid)
    {
        $type = Type::where('uuid', $uuid)
            ->firstOrFail();

        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $updateData = [
            'name' => $request->name,
        ];

        $type->update($updateData);

        return redirect()->route('types')->with('success', 'Jenis berhasil diperbarui.');
    }

    public function destroy($uuid)
    {
        $admin = Type::where('uuid', $uuid)
            ->firstOrFail();
            
        $admin->delete();

        return redirect()->route('types')->with('success', 'Jenis berhasil dihapus.');
    }
}