<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CompanyProfile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class CompanyProfileController extends Controller
{
    public function index()
    {
        $companyProfile = CompanyProfile::first();

        if (!$companyProfile) {
            // Jika belum ada, buat default data
            $companyProfile = CompanyProfile::create([
                'uuid' => Str::uuid(),
                'banner_image' => '',
                'title' => '',
                'description' => '',
                'section_one_description' => '',
                'section_two_description' => '',
                'section_three_description' => '',
            ]);
        }

        return view('dashboard.pages.company-profile', compact('companyProfile'));
    }

   public function update(Request $request, $uuid)
{
    $companyProfile = CompanyProfile::findOrFail($uuid);

    $request->validate([
        'title' => 'required|string|max:225',
        'description' => 'required|string',
        'banner_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'section_one_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'section_two_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'section_three_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $data = $request->except(['banner_image', 'section_one_image', 'section_two_image', 'section_three_image']);

    // Handle File Uploads
    $fileFields = [
        'banner_image',
        'section_one_image',
        'section_two_image',
        'section_three_image'
    ];

    foreach ($fileFields as $field) {
        if ($request->hasFile($field)) {
            // Delete old file if exists
            if ($companyProfile->$field && Storage::exists('company-profile/' . $companyProfile->$field)) {
                Storage::delete('company-profile/' . $companyProfile->$field);
            }
            
            // Store new file
            $file = $request->file($field);
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/company-profile', $fileName); // Added 'public/' prefix
            $data[$field] = $fileName;
        }
    }

    $companyProfile->update($data);

    return redirect()->back()->with('success', 'Company profile berhasil diupdate.');
}
}
