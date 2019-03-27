<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    static function manualAdd($name, $topic)
    {
        $tag = self::whereName($name)
            ->where('topic_id', $topic)
            ->first();

        if ($tag) return $tag;

        $tag = new self();

        $tag->name = $name;

        $tag->topic_id = $topic;

        $tag->save();

        return $tag;
    }

    function countOnEntity($entity)
    {
        return EntityTag::where('tag_id', $this->id)
            ->where('entity_id', $entity->id)
            //->where('is_reported', '0')
            ->count();
    }

    function isUsed($user, $entity)
    {
        return EntityTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('entity_id', $entity->id)
            ->count() > 0 ? true : false;
    }

    function isApplied($user, $entity)
    {
        return EntityTag::where('tag_id', $this->id)
            ->where('user_id', $user->id)
            ->where('entity_id', $entity->id)
            //->where('is_reported', '0')
            ->count() > 0 ? true : false;
    }

    function entityTags()
    {
        return $this->hasMany('App\EntityTag');
    }
}
