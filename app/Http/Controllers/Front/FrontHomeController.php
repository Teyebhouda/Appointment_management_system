<?php

namespace App\Http\Controllers\Front;
use App\Http\Controllers\Controller;
use App\Models\HomePageSection;
use Inertia\Inertia;

use Illuminate\Http\Request;

class FrontHomeController extends Controller
{
  public function index()
{
    $sections = HomePageSection::all()->mapWithKeys(function ($section) {
        $content = $section->content;
        // Décoder si c'est une chaîne JSON
        if (is_string($content)) {
            $content = json_decode($content, true);
        }
        return [$section->section_key => ['content' => $content]];
    })->toArray();

    return Inertia::render('Frontend/Home', [
        'sections' => $sections,
    ]);
}

    
}
