<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = "categories";
    public function children()
    {
        return $this->belongsTo(self::class, 'parent_category_id', 'id');
    }
    protected $guarded = [];

    public function images() {
        return $this->hasMany(ImageChild::class, 'category', 'id');
    }
}
