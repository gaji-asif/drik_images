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
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category', 'id');
    }
    public function subCategories()
    {
        return $this->belongsTo(Category::class, 'sub_category', 'id');
    }
}
