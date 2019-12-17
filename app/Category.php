<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = "category";
    //

    public function post_links()
    {
        return $this->belongsToMany('App\Posts', 'category_links', 'category_id', 'post_id');
    }

    public function getImage()
    {
        if (empty($this->post_links()->first()['featured_image'])) {
            return 'https://icon-library.net/images/no-image-available-icon/no-image-available-icon-6.jpg';
        }
        return $this->post_links()->first()['featured_image'];
        // dd($this);
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
