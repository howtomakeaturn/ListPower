<?php

namespace App;
use DB;
use Auth;

class AppCore
{
    protected $currentTab = '';

    protected $currentSubTab = '';

    protected $openGraphTitle = null;

    protected $openGraphImage = null;

    function setOpenGraphTitle($title)
    {
        $this->openGraphTitle = $title;
    }

    function setOpenGraphImage($image)
    {
        $this->openGraphImage = $image;
    }

    function getOpenGraphTitle()
    {
        if ($this->openGraphTitle) return $this->openGraphTitle;

        return 'ListBox 清單盒子 – 與網友們一起整理各種資料清單';
    }

    function getOpenGraphImage()
    {
        if ($this->openGraphImage) return $this->openGraphImage;

        return url('/img/ListBox.png');
    }

    function setCurrentTab($tab)
    {
        $this->currentTab = $tab;
    }

    function getCurrentTab()
    {
        return $this->currentTab;
    }

    function setCurrentSubTab($subTab)
    {
        $this->currentSubTab = $subTab;
    }

    function getCurrentSubTab()
    {
        return $this->currentSubTab;
    }

    function getContribution($topic, $user)
    {
        $entityCount = DB::table('entities')
            ->where('topic_id', $topic->id)
            ->where('user_id', $user->id)
            ->count();

        $commentCount = DB::table('comments')
            ->join('entities', 'comments.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $topic->id)
            ->where('comments.user_id', $user->id)
            ->count();

        $reviewCount = DB::table('reviews')
            ->join('entities', 'reviews.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $topic->id)
            ->where('reviews.user_id', $user->id)
            ->count();

        $editingCount = DB::table('editings')
            ->join('entities', 'editings.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $topic->id)
            ->where('editings.user_id', $user->id)
            ->count();

        $tagCount = DB::table('entity_tag')
            ->join('entities', 'entity_tag.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $topic->id)
            ->where('entity_tag.user_id', $user->id)
            ->count();

        $photoCount = DB::table('photos')
            ->join('entities', 'photos.entity_id', '=', 'entities.id')
            ->where('entities.topic_id', $topic->id)
            ->where('photos.user_id', $user->id)
            ->count();

        return [
            'entityCount' => $entityCount,
            'reviewCount' => $reviewCount,
            'editingCount' => $editingCount,
            'commentCount' => $commentCount,
            'tagCount' => $tagCount,
            'photoCount' => $photoCount,
            'user' => $user,
            'reputation' => $entityCount * 5 + $reviewCount * 5 +
                $editingCount * 5 + $commentCount * 5 + $tagCount * 1 +
                $photoCount * 5
        ];
    }

    function getContributions($topic)
    {
        $users = User::all();

        $contributions = [];

        foreach ($users as $user) {
            $contribution = $this->getContribution($topic, $user);
            if ($contribution['reputation'] > 0) $contributions[] = $contribution;
        }

        return collect($contributions)->sortByDesc('reputation');
    }

    function extractCityValue($column, $fields)
    {
        if (!property_exists($fields, $column->key)) return '';

        $value = $fields->{$column->key};

        if (!array_key_exists($value, config('city'))) return '';

        return config("city.$value.label");
    }

    protected $currentFilter = null;

    function resolveFilter($topic, $request)
    {
        $column = $topic->getFirstCityColumn();

        if ($column === null) return null;

        if ($request->has('f' . $column->id)) {
            return [
                'column' => $column,
                'filter' => $request->get('f' . $column->id)
            ];
        }

        return null;
    }

    function setCurrentFilter($filter)
    {
        $this->currentFilter = $filter;
    }

    function getCurrentFilter()
    {
        return $this->currentFilter;
    }

    protected $currentMode = null;

    function setCurrentMode($mode)
    {
        $this->currentMode = $mode;
    }

    function getCurrentMode()
    {
        return $this->currentMode;
    }

    function getMapCenter($locations)
    {
        $latArr = [];
        $lngArr = [];

        foreach($locations as $location) {
            $latArr[] = $location->latitude;
            $lngArr[] = $location->longitude;
        }

        if (count($locations) > 0) {
            return [
                'lat' => calculate_median($latArr),
                'lng' => calculate_median($lngArr),
                'zoom' => 13
            ];
        }

        return [
            'lat' => '23.825448',
            'lng' => '121.000917',
            'zoom' => 8
        ];
    }
}
