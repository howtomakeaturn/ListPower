<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InfoSection extends Model
{
    function infoColumns()
    {
        return $this->hasMany('App\InfoColumn');
    }

    function sortedInfoColumns()
    {
        return $this->infoColumns->sortBy('weight');
    }

    function clear()
    {
        foreach ($this->infoColumns as $column) {
            $column->delete();
        }

        $this->delete();
    }

    function setupColumns($columns)
    {
        // delete all legacy columns
        foreach ($this->infoColumns as $column) {
            $inData = false;

            foreach ($columns as $c) {
                if ($column->meta_key === $c->key) {
                    $inData = true;
                }
            }

            if (!$inData) $column->delete();
        }

        foreach ($columns as $index => $c) {
            $column = InfoColumn::where('info_section_id', $this->id)
                ->where('meta_key', $c->key)
                ->first();

            if (!$column) {
                $column = new InfoColumn();
                $column->info_section_id = $this->id;
                $column->meta_key = $c->key;
            }

            $column->meta_type = $c->type;
            $column->meta_label = $c->label;
            $column->weight = $index;
            $column->save();
        }
    }
}
