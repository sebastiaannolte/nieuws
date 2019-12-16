<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Posts extends Model
{
    protected $catUrl = [];

    public $table = "Posts";

    public function category_links()
    {
        return $this->belongsToMany('App\Category', 'category_links', 'post_id', 'category_id');
    }

    public function getImage()
    {
        if (empty($this->featured_image)) {
            return 'https://icon-library.net/images/no-image-available-icon/no-image-available-icon-6.jpg';
        }
        return $this->featured_image;
    }

    public function getSlug()
    {
        return $this->slug;
    }

    function category_path($category)
    {
        //$category = $this->getCategory();
        //dd($category);
        $slug = $this->getSlug();

        $lastCat = Category::where('id', $category)->pluck('category_name')->first();
        $cats = Category::where('id', $category)->pluck('category_link')->first();

        if ($cats != 0) {
            array_unshift($this->catUrl, Category::where('id', $cats)->pluck('category_name')->first());
            $this->category_path($cats);
        } else {
            //$this->catUrl[] = $lastCat;
        }

        return implode('/', $this->catUrl) . '/' . $lastCat . '/' . $slug;
    }
}
