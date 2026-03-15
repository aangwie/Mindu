<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    /**
     * Display the frontend home page.
     */
    public function index()
    {
        return view('frontend.welcome');
    }

    /**
     * Display the About Us page.
     */
    public function about()
    {
        $about_us = Setting::get('about_us', 'Informasi Tentang Kami belum tersedia.');
        return view('frontend.about', compact('about_us'));
    }

    /**
     * Display the Terms & Conditions page.
     */
    public function terms()
    {
        $terms_conditions = Setting::get('terms_conditions', 'Syarat & Ketentuan belum tersedia.');
        return view('frontend.terms', compact('terms_conditions'));
    }
}
