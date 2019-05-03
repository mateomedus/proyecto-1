<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\PostList;

class Post extends Model
{
    protected $table = 'posts';
    public $primaryKey = 'id';

    public function userList(){
        return $this->belongsTo('App\PostList');
    }
}
