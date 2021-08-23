<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function purchase_details()
    {
        return $this->hasMany('App\PurchaseDetail');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
