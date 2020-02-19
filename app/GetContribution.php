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
            //->withCount('entityTags')
            ->withCount('photos')
            ->where('id', $user->id)
            ->first();

        $tagCount = DB::table('entity_tag')
            ->join('entities', 'entity_tag.entity_id', '=', 'entities.id')
            ->where('entity_tag.user_id', $user->id)
            ->count();

        return [
            'entityCount' => $user->entities_count,
            'reviewCount' => $user->reviews_count,
            'editingCount' => $user->editings_count,
            'commentCount' => $user->comments_count,
            'tagCount' => $tagCount,
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
