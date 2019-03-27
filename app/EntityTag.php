<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EntityTag extends Model
{
    public $incrementing = false;

    protected $table = 'entity_tag';

    function tag()
    {
        return $this->belongsTo('App\Tag');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function entity()
    {
        return $this->belongsTo('App\Entity');
    }
}
