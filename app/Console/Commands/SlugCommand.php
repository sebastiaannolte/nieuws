<?php

namespace App\Console\Commands;

use App\CategoryLink;
use App\CategoryTags;
use App\Posts;
use App\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SlugCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'slug:command';

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
        $noSlugPosts = Posts::where('slug', '')->get();
        foreach ($noSlugPosts as $post) {
            $post->slug = create_slug($post->title);
            $post->save();
            dump('updated');
        }
        dump('done');
        // if (Posts::whereEmpty('slug')->get()) {
        //     dd('empty');
        // }
        // DB::table('posts')->where('categorized', '=', 1)->update(array('categorized' => 0));
    }
}
