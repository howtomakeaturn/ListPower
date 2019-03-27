<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Review extends Model
{
    function user()
    {
        return $this->belongsTo('App\User');
    }

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    function reviewCells()
    {
        return $this->hasMany('App\ReviewCell');
    }

    function approve()
    {
        $this->entity->refreshReviewFields();
    }

    function value($key)
    {
        $arr = [];

        foreach ($this->reviewCells as $cell) {
            if ($cell->meta_key === $key) return $cell->meta_value;
        }

        return null;
    }
}
