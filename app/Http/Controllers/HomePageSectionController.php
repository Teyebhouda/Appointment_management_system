<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageSectionController extends Controller
{
    
    /**
     * Display the specified section.
     *
     * @param string $sectionKey
     * @return \Illuminate\Http\Response
     */
    public function show($sectionKey)
    {
        $section = HomePageSection::where('section_key', $sectionKey)->firstOrFail();

        return Inertia::render('Home/Section', [
            'section' => $section->content,
        ]);
    }

    // Add other methods as needed for editing, updating, etc.
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

        return redirect()->back()->with('success', ucfirst($sectionKey) . ' section mise à jour !');
    }

    protected function getValidatedData(Request $request, string $sectionKey)
    {
        switch ($sectionKey) {
            case 'hero':
                return $request->validate([
                    'title' => 'nullable|string|max:255',
                    'subtitle' => 'nullable|string|max:500',
                    'button_text' => 'nullable|string|max:100',
                ]);
            case 'services':
                return $request->validate([
                    'title' => 'nullable|string|max:255',
                    'description' => 'nullable|string|max:500',
                ]);
            // Add more cases for other sections as needed
            default:
                return [];
        }
    }
}
