<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Editing extends Model
{
    function entity()
    {
        return $this->belongsTo('App\Entity');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function editingCells()
    {
        return $this->hasMany('App\EditingCell');
    }

    function approve()
    {
        $entity = $this->entity;

        foreach ($this->editingCells as $cell) {
            $field = InfoField::where('entity_id', $entity->id)
                ->where('meta_key', $cell->meta_key)
                ->first();

            if (!$field) {
                $field = new InfoField();
                $field->entity_id = $entity->id;
                $field->meta_key = $cell->meta_key;
            }

            $field->meta_value = $cell->meta_value;

            $field->save();
        }

        if ($this->name) $entity->name = $this->name;

        $entity->save();
    }
}
