<?php

namespace App;

class FetchFeeds
{
    function fetchAdd($topic)
    {
        $records = [];

        $entities = Entity::where('topic_id', $topic->id)->orderBy('created_at', 'desc')->get();

        foreach ($entities as $entity) {
            $records[] = [
                'data' => $entity,
                'type' => 'add',
                'timestamp' => $entity->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchReview($topic)
    {
        $records = [];

        $reviews = \App\Review::join('entities', 'reviews.entity_id', 'entities.id')
            ->select('reviews.*')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($reviews as $review) {
            $records[] = [
                'data' => $review,
                'type' => 'review',
                'timestamp' => $review->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchEditing($topic)
    {
        $records = [];

        $editings = Editing::join('entities', 'editings.entity_id', 'entities.id')
            ->select('editings.*')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($editings as $editing) {
            $records[] = [
                'data' => $editing,
                'type' => 'editing',
                'timestamp' => $editing->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchComment($topic)
    {
        $records = [];

        $comments = \App\Comment::join('entities', 'comments.entity_id', 'entities.id')
            ->select('comments.*')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($comments as $comment) {
            $records[] = [
                'data' => $comment,
                'type' => 'comment',
                'timestamp' => $comment->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchTag($topic)
    {
        $tags = EntityTag::join('entities', 'entity_tag.entity_id', 'entities.id')
            ->select('entity_tag.*')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $records = [];

        foreach ($tags as $tag) {
            $records[] = [
                'data' => $tag,
                'type' => 'tag',
                'timestamp' => $tag->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchPhoto($topic)
    {
        $records = [];

        $photos = \App\Photo::join('entities', 'photos.entity_id', 'entities.id')
            ->select('photos.*')
            ->where('topic_id', $topic->id)
            ->orderBy('created_at', 'desc')
            ->get();

        foreach ($photos as $photo) {
            $records[] = [
                'data' => $photo,
                'type' => 'photo',
                'timestamp' => $photo->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchAll($topic)
    {
        /*
        $arr = array_merge(
            $this->fetchAdd($topic),
            $this->fetchEditing($topic),
            $this->fetchReview($topic),
            $this->fetchComment($topic)
        );

        usort($arr, function ($item1, $item2) {
            return $item2['timestamp'] <=> $item1['timestamp'];
        });
        */

        $collection = collect([]);

        $collection = $collection->merge($this->fetchAdd($topic));

        $collection = $collection->merge($this->fetchEditing($topic));

        $collection = $collection->merge($this->fetchReview($topic));

        $collection = $collection->merge($this->fetchComment($topic));

        $collection = $collection->merge($this->fetchTag($topic));

        $collection = $collection->merge($this->fetchPhoto($topic));

        $collection = $collection->sortByDesc('timestamp');

        return $collection;
    }
}
