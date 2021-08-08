<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contributor extends Model
{
    protected $table = "contributors";

    protected $fillable = ["name", "email"];
}
