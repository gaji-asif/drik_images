<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\User;

class ImageChild extends Model
{
    protected $table = "all_images_childs";

    protected $guarded = [];

    public function imageAuthor()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
