<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

    protected $appends = ['comments_count'];


    public function user ()
    {
        return $this->belongsTo('App\User');
    }

    public function comments ()
    {
        return $this->hasMany('App\Comment');
    }

    public function getCommentsCountAttribute()
    {
        return $this->comments()->count();
    }

    public function getTagsAttribute($value)
    {
        return json_decode($value);
    }
}
