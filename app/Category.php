<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $fillable = ['name', 'background_color', 'text_color', 'selected_color'];
    public $timestamps = false;

    public function ideas()
    {
        return $this->belongsToMany('App\Idea', 'categories_ideas');
    }
}
