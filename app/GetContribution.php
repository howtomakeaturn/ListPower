<?php

namespace App;

use DB;

class GetContribution
{
    function getContribution($user)
    {
        $entityCount = DB::table('entities')
            ->where('user_id', $user->id)
            ->count();

        $commentCount = DB::table('comments')
            ->join('entities', 'comments.entity_id', '=', 'entities.id')
            ->where('comments.user_id', $user->id)
            ->count();

        $reviewCount = DB::table('reviews')
            ->join('entities', 'reviews.entity_id', '=', 'entities.id')
            ->where('reviews.user_id', $user->id)
            ->count();

        $editingCount = DB::table('editings')
            ->join('entities', 'editings.entity_id', '=', 'entities.id')
            ->where('editings.user_id', $user->id)
            ->count();

        $tagCount = DB::table('entity_tag')
            ->join('entities', 'entity_tag.entity_id', '=', 'entities.id')
            ->where('entity_tag.user_id', $user->id)
            ->count();

        $photoCount = DB::table('photos')
            ->join('entities', 'photos.entity_id', '=', 'entities.id')
            ->where('photos.user_id', $user->id)
            ->count();

        return [
            'entityCount' => $entityCount,
            'reviewCount' => $reviewCount,
            'editingCount' => $editingCount,
            'commentCount' => $commentCount,
            'tagCount' => $tagCount,
            'photoCount' => $photoCount,
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
