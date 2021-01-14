<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
protected $fillable=['file'];

protected $uploads='/images/profile_pictures/';

protected $defaultPic='';

public function getFileAttribute($photo){
    return $this->uploads.$photo;
}




}
