<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }
}
