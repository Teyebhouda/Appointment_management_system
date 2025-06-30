<?php

namespace App\Http\Controllers;
use App\Models\HomePageSection;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sections = HomePageSection::all()->pluck('content', 'section_key')->map(function ($content) {
            return json_decode($content, true);
        });
        return view('home', [
            'sections' => $sections,
        ]);

    }
}
