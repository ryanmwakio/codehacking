<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    //
    protected $fillable=[
        'user_id',
        'category_id',
        'photo_id',
        'title',
        'body'
    ];
}
