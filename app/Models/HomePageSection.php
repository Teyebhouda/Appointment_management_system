<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomePageSection extends Model
{
    
    protected $table = 'home_page_sections';

    protected $fillable = [
        'section_key',
        'content',
    ];

    protected $casts = [
        'content' => 'array', // Cast content to array for JSON handling
    ];

    /**
     * Get the section content by key.
     *
     * @param string $key
     * @return mixed
     */
    public static function getContentByKey($key)
    {
        return self::where('section_key', $key)->first()?->content;
    }
}
