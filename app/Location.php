<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    function topic()
    {
        return $this->belongsTo('App\Entity');
    }
}
