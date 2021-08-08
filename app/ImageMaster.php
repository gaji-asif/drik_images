<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\ImageChild;

class ImageMaster extends Model
{
    protected $table = "all_images_masters";

    protected $guarded = [];

    public function images() {
        return $this->hasMany("ImageChild", "master_id", "id");
    }
}
