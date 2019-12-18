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
    protected $post;


    public function index()
    {
        return view('index', [
            'menu' => $this->getMenu(),
            'posts' => $this->getMainPosts(5),
        ]);
    }

    public function post($slug)
    {
        $slug = basename($slug);


        $post = Posts::where('slug', $slug)->first();

        if ($post == null) {
            return view('errors.404', ['msg' => 'Post not found!', 'menu' => $this->getMenu()]);
        }

        // dd($path, $segments);
        if ($post->slug != $slug) {
            return view('errors.404', ['msg' => 'Post not found!!', 'menu' => $this->getMenu()]);
        }

        return view('post', [
            'menu' => $this->getMenu(),
            'post' => $post,
            // 'newPosts' => $this->getNewPosts(5),
            // 'relatedPosts' => $this->getRelatedPosts(3),
        ]);
    }

    public function category($name)
    {
        $name = basename($name);

        $sub_menu = Category::where('category_link', Category::where('category_name', $name)->pluck('id'))->get();

        $cat = Category::where('category_name', $name)->first();
        $this->category_tree($cat->category_link); //needed?

        $this->tags($cat->id);




        // $posts = $this->get_multi_result_set($this->tags)->paginate(5);

        // $categories = Category::with('post_links')->whereIn('id', $this->tags)->get()->post_links()->paginate(5);
        // $posts = $categories->post_links();
        // dd($categories);

        // $cats = Category::whereIn('id', $this->tags)->firstOrFail();

        // $posts = Category::whereIn('id', $this->tags)->with('post_links')->get();
        // $posts->first()->post_links()->paginate(10);
        // dd($posts);

        $posts = Category::with('post_links')->whereIn('id', $this->tags)->paginate(10);
        // $posts->getCollection()->transform(function ($item) {
        //     return $item;
        // });

        if ($posts->isEmpty()) {
            return view('errors.404', ['msg' => 'No posts found!', 'menu' => $this->getMenu()]);
        }


        $prevCat = (request()->segment(count(request()->segments()) - 1));
        $categoryPrev = Category::where('category_name', $prevCat)->pluck('id');
        $catIddd = Category::where('category_name', $name)->pluck('id')->first();

        if (count(Category::where('category_link', $catIddd)->get()) == 0 && !$categoryPrev->isEmpty()) {
            $sub_menu = Category::where('category_link', $categoryPrev)->get();
        } else {
            $this->urls[] = $name; // needed?
        }

        return view('category', [
            'menu' => $this->getMenu(),
            'sub_menu' => $sub_menu,
            'urls' => implode('/', $this->urls),
            'posts' => $posts,

            // 'newPosts' => $this->getNewPosts(5),
            // 'relatedPosts' => $this->getRelatedPosts(5),
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

    function tags($parent = 0, $catId = null)
    {
        $cats = Category::where('category_link', $parent)->get();

        if (!in_array($parent, $this->tags)) {
            $this->tags[] = $parent;
        }


        foreach ($cats as $value) {
            $this->tags[] = $value->id;
            $this->tags($value->id);
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

    // function get_multi_result_set($statement)
    // {
    //     $resultSet = [];

    //     foreach ($statement as $item) {
    //         $postIds = CategoryLink::where('category_id', $item)->pluck('post_id');
    //         $posts = Posts::with('category_links')->whereIn('id', $postIds)->get();

    //         foreach ($posts as $value) {
    //             if ($posts->isNotEmpty()) {
    //                 array_push($resultSet, $value);
    //             }
    //         }
    //     }

    //     return collect($resultSet)->unique();
    // }

    function getNewPosts($number)
    {
        $categoryLink = CategoryLink::get();
        return  Posts::with('category_links')->orderBy('created_at', 'DESC')->where('categorized', 1)->whereIn('id', $categoryLink->id)->get()->take(5);
    }

    function getMainPosts($number)
    {
        $postIds = CategoryLink::pluck('post_id');
        return Posts::with('category_links')->orderBy('created_at', 'DESC')->where('categorized', 1)->whereIn('id', $postIds)->get()->paginate($number);
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
