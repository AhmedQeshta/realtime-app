<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'posts';
    protected $fillable = [
        'title', 'body', 'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function comments(){
        return $this->hasMany(Comment::class,'post_id','id');
    }
}
