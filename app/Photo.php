<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
protected $fillable=['file'];

protected $profilePicturePath='/images/profile_pictures/';
protected $postPicturePath='/images/post_pictures/';

protected $defaultPic='';

public function getProfilePictureAttribute($photo){
    return $this->profilePicturePath.$photo;
}

public function getPostPictureAttribute($photo){
    return $this->postPicturePath.$photo;
}




}
