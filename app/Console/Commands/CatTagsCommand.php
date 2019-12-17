<?php

namespace App\Console\Commands;

use App\CategoryLink;
use App\CategoryTags;
use App\Posts;
use App\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CatTagsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cattags:command';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        CategoryTags::truncate();
        $categories = Category::get();

        foreach ($categories as $value) {
            // dd($value->category_name);
            $category = new CategoryTags();
            $category->category_id = $value->id;
            $category->tag = $value->category_name;
            $category->save();
        }
    }
}
