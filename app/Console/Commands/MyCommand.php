<?php

namespace App\Console\Commands;

use App\CategoryLink;
use App\CategoryTags;
use App\Posts;
use App\Category;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class MyCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'my:command';

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
        CategoryLink::truncate();
        DB::table('posts')->where('categorized', '=', 1)->update(array('categorized' => 0));

        $posts = Posts::where('categorized', 0)->get();
        $tags = CategoryTags::get();

        foreach ($posts as $post) {
            foreach ($tags as $tag) {


                // if (strpos(strtolower($post->description), strtolower($tag->tag)) !== false) {
                $word = strtolower($tag->tag);
                if (preg_match("/\b$word\b/", strtolower($post->description))) {
                    // word found


                    //category found, save
                    $categoryLink = new CategoryLink();
                    $categoryLink->category_id = $tag->category_id;
                    $categoryLink->post_id = $post->id;
                    $categoryLink->save();
                    dump('gill');
                }
                //save the post
                $donepost = Posts::find($post->id);

                $donepost->categorized = 1;
                $donepost->save();
            }
        }

        dump('done');
    }
}
