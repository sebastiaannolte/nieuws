<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoryTags extends Model
{
    public $timestamps = false;
    protected $fillable = ['category_id'];
}
