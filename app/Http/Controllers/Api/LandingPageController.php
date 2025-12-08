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
        // Ambil data profil (ambil yang pertama aja)
        $profile = CompanyProfile::first();

        // Ambil semua layanan
        $services = Service::all();

        return response()->json([
            'status' => 'success',
            'data' => [
                'profile' => $profile,
                'services' => $services,
                // Helper agar frontend tau base URL gambar
                'image_base_url' => asset('storage/'), 
            ]
        ]);
    }
}