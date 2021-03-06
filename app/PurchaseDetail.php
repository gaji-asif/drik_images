<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    public function purchase()
    {
        return $this->belongsTo('App\Purchase')->with('user');
    }
}
