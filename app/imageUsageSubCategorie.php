<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class imageUsageSubCategorie extends Model
{
    use HasFactory;

    public function categories(){
		return $this->belongsTo(imageUsageCategorie::class, 'category_id', 'id');
	}
}
