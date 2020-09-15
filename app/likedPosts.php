<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class likedPosts extends Model
{
    protected $table = 'liked_posts';
    protected $fillable=['user_id','post_id'];
}
