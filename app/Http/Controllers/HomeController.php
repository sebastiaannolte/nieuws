<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryLink;
use App\CategoryTags;
use App\Posts;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $urls = [];
    protected $tags = [];
    protected $catUrl = [];
    protected $namec = [];


    public function index()
    {
        return view('index', [
            'menu' => $this->getMenu(),
            'newPosts' => $this->getNewPosts(5),
            'posts' => $this->getMainPosts(5),
        ]);
    }

    public function category($name)
    {
        $catNameIfPost = basename(dirname($name));
        $name = basename($name);



        if (Category::where('category_name', '=', create_title($name))->exists() == 0) {

            $slug = $name;
            $post = Posts::where('slug', $slug)->first();

            if ($post == null) {
                return view('errors.404', ['msg' => 'Post not found!', 'menu' => $this->getMenu()]);
            }
            $segments = implode('/', request()->segments());
            $path = $post->category_path($post->category_links->first()->id);
            //dd($path, $segments);
            if ($path != $segments) {
                return view('errors.404', ['msg' => 'Post not found!!', 'menu' => $this->getMenu()]);
            }

            return view('post', [
                'menu' => $this->getMenu(),
                'post' => $post,
                'tags' =>  $post->category_links->pluck('category_name'),
                'newPosts' => $this->getNewPosts(5),
                'relatedPosts' => $this->getRelatedPosts(3),
            ]);
        }

        if (Category::where('category_name', $name)->get()->isEmpty()) {
            return view('errors.404', ['msg' => 'Post not found!', 'menu' => $this->getMenu()]);
        }

        $sub_menu = Category::where('category_link', Category::where('category_name', $name)->pluck('id'))->get();

        $this->category_tree(Category::where('category_name', $name)->pluck('category_link'));
        $this->tags(Category::where('category_name', $name)->pluck('id'));




        $thisCategory = Category::where('category_name', $name)->pluck('id');
        //dd($thisCategory);
        $categoryTag = CategoryTags::where('category_id', $thisCategory)->pluck('category_id');
        //dd($categoryTag);




        if (!$categoryTag->isEmpty()) {
            //if tag is set take from db.
            $this->tags[] = $categoryTag[0];
        }



        // $posts = $this->get_multi_result_set($this->tags)->paginate(5);
        $posts = Posts::get()->paginate(5);
        //$posts = Category::whereIn('id', $this->tags)->with('post_links')->get();
        // $posts = $posts->getRelationValue('');
        // foreach ($posts as $value) {
        //     dd($value->post_links->first()->getImage());
        // }


        // if ($posts->isEmpty()) {
        //     return view('errors.404', ['msg' => 'No posts found!', 'menu' => $this->getMenu()]);
        // }


        //if missing urls, add this
        //$this->urls[] = $name;

        $prevCat = (request()->segment(count(request()->segments()) - 1));
        $catIddd = Category::where('category_name', $name)->pluck('id')->first();

        if (count(Category::where('category_link', $catIddd)->get()) == 0 && !Category::where('category_name', $prevCat)->pluck('id')->isEmpty()) {


            $sub_menu = Category::where('category_link', Category::where('category_name', $prevCat)->pluck('id'))->get();
        } else {
            $this->urls[] = $name;
        }



        return view('category', [
            'menu' => $this->getMenu(),
            'sub_menu' => $sub_menu,
            'urls' => implode('/', $this->urls),
            'posts' => $posts,


            'newPosts' => $this->getNewPosts(5),
            'relatedPosts' => $this->getRelatedPosts(5),


        ]);
    }


    function category_tree($parent = 0)
    {
        $cats = Category::where('id', $parent)->get();
        foreach ($cats as $item) {
            $items = $item->category_name;
            $this->category_tree($item->category_link);
            if (!in_array($items, $this->urls)) {
                $this->urls[] = $items;
            }
        }
    }

    function tags($parent = 0)
    {
        $cats = Category::where('category_link', $parent)->get();

        foreach ($cats as $item) {

            $items = $item->category_id;
            $items = CategoryTags::where('category_id', $item->id)->pluck('category_id')->first();
            $this->tags($item->id);
            if ($items) {
                $this->tags[] = $items;
            }
        }
    }

    // function category_path($category, $slug = null)
    // {

    //     $lastCat = Category::where('id', $category)->pluck('category_name')->first();
    //     $cats = Category::where('id', $category)->pluck('category_link')->first();

    //     if ($cats != 0) {
    //         array_unshift($this->catUrl, Category::where('id', $cats)->pluck('category_name')->first());
    //         $this->category_path($cats);
    //     } else {
    //         //$this->catUrl[] = $lastCat;
    //     }

    //     return implode('/', $this->catUrl) . '/' . $lastCat . '/' . $slug;
    // }

    function get_multi_result_set($statement)
    {
        $resultSet = [];

        foreach ($statement as $item) {
            $postIds = CategoryLink::where('category_id', $item)->pluck('post_id');
            $posts = Posts::with('category_links')->whereIn('id', $postIds)->get();

            foreach ($posts as $value) {
                if ($posts->isNotEmpty()) {
                    array_push($resultSet, $value);
                }
            }
        }

        return collect($resultSet)->unique();
    }

    function getNewPosts($number)
    {

        $postIds = CategoryLink::pluck('post_id');

        return  Posts::orderBy('created_at', 'DESC')->where('categorized', 1)->whereIn('id', $postIds)->get()->take(5);
    }

    function getMainPosts($number)
    {

        $postIds = CategoryLink::pluck('post_id');

        return  Posts::orderBy('created_at', 'DESC')->where('categorized', 1)->whereIn('id', $postIds)->paginate($number);
    }

    function getMenu()
    {
        return Category::where('category_link', 0)->get();
    }

    function getRelatedPosts($number)
    {
        $postIds = CategoryLink::pluck('post_id');

        return  Posts::orderBy('created_at', 'DESC')->where('categorized', 1)->whereIn('id', $postIds)->get()->take($number);
    }
}
