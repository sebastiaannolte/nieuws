<?php

use App\Category;



function time_elapsed_string($datetime, $full = false)
{
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'jaar',
        'm' => 'maand',
        'w' => 'week',
        'd' => 'dag',
        'h' => 'uur',
        'i' => 'minuten',
        's' => 'seconden',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 'en' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' geleden' : 'Net';
}

function create_slug($string)
{
    $slug = preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
    return strtolower($slug);
}

function create_title($slug)
{
    $string = str_replace('-', ' ', $slug);
    return strtolower($string);
}
function category_path($category, $postTitle = null)
{
    //dd($category);
    $lastCat = Category::where('id', $category)->pluck('category_name')->first();
    $cats = Category::where('id', $category)->pluck('category_link')->first();
    $catUrl = [];
    //dd($cats);
    //dump(Category::where('id', $cats)->pluck('category_name')->first());
    //$this->catUrl[] = Category::where('id', $cats)->pluck('category_name')->first(); // No
    if ($cats != 0) {
        array_unshift($catUrl, Category::where('id', $cats)->pluck('category_name')->first());
        //$this->catUrl[] = Category::where('id', $cats)->pluck('category_name')->first();
        category_path($cats);
    } else {
        //$catUrl[] = $lastCat;
    }
    //dump($this->catUrl);

    return implode('/', $catUrl) . '/' . $lastCat . '/' . create_slug($postTitle);
}
