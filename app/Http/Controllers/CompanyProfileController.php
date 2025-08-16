<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Feedback;
use App\Models\Store;


class CompanyProfileController extends Controller
{
    public function index()
    {
        $stores = Store::latest()
        ->get();
        $companyProfile =  CompanyProfile::first();
        $feedback = Feedback::latest()
        ->get();

        return view('pages.company-profile', compact('companyProfile', 'feedback', 'stores'));
    }
}
