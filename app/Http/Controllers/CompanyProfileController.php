<?php

namespace App\Http\Controllers;

use App\Models\CompanyProfile;
use App\Models\Feedback;
use App\Models\Store;


class CompanyProfileController extends Controller
{
    public function index()
    {
        
        $companyProfile =  CompanyProfile::first();

        return view('pages.company-profile', compact('companyProfile'));
    }
}
