<?php

namespace App\Http\Controllers;

use App\Models\LoyaltyProgram;
use Illuminate\Http\Request;

class SanaaCardsController extends Controller
{
    public function index()
    {
        $settings = \App\Models\SanaaCardsPageSetting::getAllSettings();
        return view('sanaa-cards.index', compact('settings'));
    }

    public function features()
    {
        return view('sanaa-cards.features');
    }

    public function pricing()
    {
        return view('sanaa-cards.pricing');
    }
}
