<?php

namespace App;

class FetchAllFeeds
{
    function fetchAdd()
    {
        $records = [];

        $entities = Entity::orderBy('created_at', 'desc')->get();

        foreach ($entities as $entity) {
            $records[] = [
                'data' => $entity,
                'type' => 'add',
                'timestamp' => $entity->created_at->timestamp,
            ];
        }

        return collect($records);
    }

    function fetchReview()
    {
        $records = [];

        $reviews = \App\Review::join('entities', 'reviews.entity_id', 'entities.id')
            ->select('reviews.*')
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

    function fetchEditing()
    {
        $records = [];

        $editings = Editing::join('entities', 'editings.entity_id', 'entities.id')
            ->select('editings.*')
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

    function fetchComment()
    {
        $records = [];

        $comments = \App\Comment::join('entities', 'comments.entity_id', 'entities.id')
            ->select('comments.*')
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

    function fetchTag()
    {
        $tags = EntityTag::join('entities', 'entity_tag.entity_id', 'entities.id')
            ->select('entity_tag.*')
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

    function fetchPhoto()
    {
        $records = [];

        $photos = \App\Photo::join('entities', 'photos.entity_id', 'entities.id')
            ->select('photos.*')
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

    function fetchAll()
    {
        $collection = collect([]);

        $collection = $collection->merge($this->fetchAdd());

        $collection = $collection->merge($this->fetchEditing());

        $collection = $collection->merge($this->fetchReview());

        $collection = $collection->merge($this->fetchComment());

        $collection = $collection->merge($this->fetchTag());

        $collection = $collection->merge($this->fetchPhoto());

        $collection = $collection->sortByDesc('timestamp');

        return $collection;
    }
}
