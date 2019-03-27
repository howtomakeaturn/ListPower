<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReviewField extends Model
{
    function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }
}
