<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryLink extends Model
{
    // public function categoryLink()
    // {
    //     return $this->belongsTo('App\Category', 'category_id');
    // }

    // public function topics()
    // {
    //     return $this->hasManyThrough('App\Posts', 'App\CategoryLink', 'id', 'category_id');
    // }

    public function categories()
    {
        return $this->hasManyThrough('App\Posts', 'App\CategoryLink', 'id', 'category_id');
    }
}
