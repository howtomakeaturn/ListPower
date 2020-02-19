<?php

namespace App;

use DB;

class GetContribution
{
    function getContribution($user)
    {
        $user = User::withCount('entities')
            ->withCount('comments')
            ->withCount('reviews')
            ->withCount('editings')
            ->withCount('entityTags')
            ->withCount('photos')
            ->where('id', $user->id)
            ->first();

        return [
            'entityCount' => $user->entities_count,
            'reviewCount' => $user->reviews_count,
            'editingCount' => $user->editings_count,
            'commentCount' => $user->comments_count,
            'tagCount' => $user->entity_tags_count,
            'photoCount' => $user->photos_count,
            'user' => $user
        ];
    }

    function getContributions()
    {
        $users = User::all();

        $contributions = [];

        foreach ($users as $user) {
            $contributions[] = $this->getContribution($user);
        }

        return collect($contributions);

    }
}
