<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Comment extends Model
{
    function user()
    {
        return $this->belongsTo('App\User');
    }

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }
}
