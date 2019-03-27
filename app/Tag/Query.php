<?php

namespace App\Tag;

use DB;
use App\Tag;

class Query
{

    function getAllByUserOnEntity($user, $entity)
    {
        $rows = DB::table('entity_tag')->where('entity_id', $entity->id)
            ->where('user_id', $user->id)
            //->where('is_reported', '0')
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->tag_id;
        }

        $tags = Tag::findMany($ids);

        return $tags;
    }

    function getAllByUserNotOnEntity($user, $entity)
    {
        $rows = DB::table('entity_tag')
            ->join('entities', 'entity_tag.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $entity->topic->id)
            ->where('entity_id', '!=', $entity->id)
            ->where('entity_tag.user_id', $user->id)
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->tag_id;
        }

        $tags = Tag::findMany($ids);

        $alreadyUsedTags = $this->getAllByUserOnEntity($user, $entity);

        foreach ($tags as $index => $tag) {
            foreach ($alreadyUsedTags as $alreadyUsedTag) {
                if ($alreadyUsedTag->id === $tag->id) {
                    $tags->forget($index);
                }
            }
        }

        return $tags;
    }

    function getAllByNotUserNotOnEntity($user, $entity)
    {
        $rows = DB::table('entity_tag')
            ->join('entities', 'entity_tag.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $entity->topic->id)
            ->where('entity_id', '!=', $entity->id)
            ->where('entity_tag.user_id', '!=', $user->id)
            ->get();

        $ids = [];

        foreach ($rows as $row) {
            $ids[] = $row->tag_id;
        }

        $tags = Tag::findMany($ids);

        $alreadyUsedTags = $this->getAllByUserOnEntity($user, $entity);

        foreach ($tags as $index => $tag) {
            foreach ($alreadyUsedTags as $alreadyUsedTag) {
                if ($alreadyUsedTag->id === $tag->id) {
                    $tags->forget($index);
                }
            }
        }

        return $tags;
    }
}
