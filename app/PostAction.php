<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PostAction extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'post_id', 'user_id', 'title', 'description', 'type',
    ];

    public function post()
    {
        return $this->belongsTo('App\Post', 'post_id', 'id');
    }
}
