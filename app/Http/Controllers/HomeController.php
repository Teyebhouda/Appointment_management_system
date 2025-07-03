<?php

namespace App\Http\Controllers;
use App\Models\HomePageSection;
use Inertia\Inertia;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $sections = HomePageSection::all()->mapWithKeys(function ($section) {
            return [$section->section_key => $section->content];
        });
       
        return Inertia::render('Admin/HomePage/edit', [
            'sections' => $sections,
            
        ]); 

    }
    public function show($sectionKey)
    {
        $section = HomePageSection::where('section_key', $sectionKey)->firstOrFail();
        
        return Inertia::render('Home/Section', [
            'section' => $section->content,
        ]);
    }
    public function edit($sectionKey)
    {
        $section = HomePageSection::where('section_key', $sectionKey)->firstOrFail();
        
        return Inertia::render('Home/EditSection', [
            'section' => $section,
        ]);
    }
    public function update(Request $request, $sectionKey)
    {
        $data = $this->getValidatedData($request, $sectionKey);

    HomePageSection::updateOrCreate(
        ['section_key' => $sectionKey],
        ['content' => json_encode($data)]
    );

    return redirect()->back()->with('success', ucfirst($sectionKey).' section mise à jour !');

    }



   protected function getValidatedData(Request $request, string $sectionKey)
{
    switch ($sectionKey) {
        case 'hero':
            return $request->validate([
                'title' => 'nullable|string|max:255',
                'subtitle' => 'nullable|string|max:500',
                'button_text' => 'nullable|string|max:100',
                'background_image' => 'nullable|url',
            ]);

       case 'howItWork':
    return $request->validate([
        'title' => 'required|string|max:255',
        'subtitle' => 'required|string|max:500',
        'steps' => 'required|array|size:3',
        'steps.*.icon' => 'required|string|max:10',
        'steps.*.title' => 'required|string|max:255',
        'steps.*.description' => 'required|string|max:500',
    ]);

        case 'services':
            return $request->validate([
                'title' => 'required|string|max:255',
                'items' => 'required|array|min:1',
                'items.*.id' => 'nullable|integer',
                'items.*.title' => 'required|string|max:255',
                'items.*.description' => 'required|string|max:500',
                'items.*.icon' => 'nullable|string|max:50',
            ]);

        case 'testimonials':
            return $request->validate([
                'title' => 'required|string|max:255',
                'items' => 'required|array|min:1',
                'items.*.name' => 'required|string|max:100',
                'items.*.comment' => 'required|string|max:500',
                'items.*.photo' => 'nullable|url',
            ]);

           case 'footer':
            return $request->validate([
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string|max:1000',
                'links' => 'nullable|array',
                'links.*.title' => 'required_with:links|string|max:255',
                'links.*.url' => 'required_with:links|url|max:1000',
            ]);

        

        default:
            abort(404, 'Section inconnue');
    }
}

    public function create()
    {
        return Inertia::render('Home/CreateSection');   

    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'section_key' => 'required|string|unique:home_page_sections,section_key',
            'content' => 'required|array',
        ]);
        
        HomePageSection::create($validatedData);
        
        return redirect()->route('home.index')->with('success', 'Section created successfully.');
    }
    
}
