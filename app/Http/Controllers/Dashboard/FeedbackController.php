<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class FeedbackController extends Controller
{
    public function index()
    {
        $feedback = Feedback::latest()->paginate(5);
        return view('dashboard.pages.feedback.index', compact('feedback'));
    }

    public function create()
    {
        return view('dashboard.pages.feedback.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:225',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only('name', 'description');
        $data['uuid'] = Str::uuid();

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/feedback', $fileName); // Store in public disk
            $data['image'] = $fileName;
        }

        Feedback::create($data);
        return redirect()->route('feedback')->with('success', 'Feedback berhasil ditambahkan.');
    }

    public function edit($uuid)
    {
        $feedback = Feedback::findOrFail($uuid);
        return view('dashboard.pages.feedback.edit', compact('feedback'));
    }

    public function update(Request $request, $uuid)
    {
        $feedback = Feedback::findOrFail($uuid);

        $request->validate([
            'name' => 'required|string|max:225',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        $data = $request->only('name', 'description');

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($feedback->image && Storage::exists('public/feedback/' . $feedback->image)) {
                Storage::delete('public/feedback/' . $feedback->image);
            }
            
            // Store new image
            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/feedback', $fileName);
            $data['image'] = $fileName;
        }

        $feedback->update($data);
        return redirect()->route('feedback')->with('success', 'Feedback berhasil diupdate.');
    }

    public function destroy($uuid)
    {
        $feedback = Feedback::findOrFail($uuid);
        
        // Delete associated image if exists
        if ($feedback->image && Storage::exists('public/feedback/' . $feedback->image)) {
            Storage::delete('public/feedback/' . $feedback->image);
        }
        
        $feedback->delete();

        return redirect()->route('feedback')->with('success', 'Feedback berhasil dihapus.');
    }
}