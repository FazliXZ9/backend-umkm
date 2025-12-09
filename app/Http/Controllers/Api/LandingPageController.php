<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use App\Models\Service;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    public function index()
    {
        $profile = CompanyProfile::first();
        $services = Service::all();

        return response()->json([
            'status' => 'success',
            'data' => [
                'profile' => $profile,
                'services' => $services,
                'image_base_url' => asset('storage/'), 
            ]
        ]);
    }
}