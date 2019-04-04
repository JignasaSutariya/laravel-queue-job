<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'title', 'description'
    ];

    public function actions()
    {
        return $this->hasMany('App\PostAction');
    }

    public function postedBy()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
