<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;
use AppCore;

class Entity extends Model
{
    const STATUS_HIDDEN = -10;
    const STATUS_PUBLIC = 0;
    const STATUS_SEMI_PUBLIC = 10;

    function hashids()
    {
        return Hashids::encode($this->id);
    }

    function topic()
    {
        return $this->belongsTo('App\Topic');
    }

    function user()
    {
        return $this->belongsTo('App\User');
    }

    function comments()
    {
        return $this->hasMany('App\Comment');
    }

    function reviews()
    {
        return $this->hasMany('App\Review');
    }

    function editings()
    {
        return $this->hasMany('App\Editing');
    }

    function reviewFields()
    {
        return $this->hasMany('App\ReviewField');
    }

    function infoFields()
    {
        return $this->hasMany('App\InfoField');
    }

    public function tags()
    {
        return $this->belongsToMany('App\Tag');
    }

    function uniqueTags()
    {
        $tags = collect([]);

        foreach ($this->tags as $rawTag) {
            foreach ($tags as $tag) {
                if ($tag->id === $rawTag->id) continue 2;
            }

            $tags->push($rawTag);
        }

        return $tags;
    }

    function photos()
    {
        return $this->hasMany('App\Photo');
    }

    function location()
    {
        return $this->hasOne('App\Location');
    }

    function getSortedTags()
    {
        $entity = $this;

        return $this->uniqueTags()->sortByDesc(function($tag)use($entity){
            return $tag->countOnEntity($entity);
        });
    }

    function getAddressInfo()
    {
        $sections = $this->topic->infoSections;

        foreach ($sections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($column->meta_type === 'address') {
                    return $this->showInfo($column->meta_key);
                }
            }
        }

        return null;
    }

    function getCityInfos()
    {
        $sections = $this->topic->infoSections;

        $result = [];

        foreach ($sections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($column->meta_type === 'city') {
                    // $result[] = AppCore::extractCityValue($column, $infoFields);
                    $result[] = $this->showInfo($column->meta_key);
                }
            }
        }

        return collect($result);
    }

    function getCityInfo()
    {
        $sections = $this->topic->infoSections;

        $result = [];

        foreach ($sections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($column->meta_type === 'city') {
                    return $this->showInfo($column->meta_key);
                }
            }
        }

        return null;
    }

    function addressForGoogle()
    {
        $address= '';

        if ($this->getCityInfo()) $address .= $this->getCityInfo();

        if ($this->getAddressInfo()) $address .= $this->getAddressInfo();

        return trim($address);
    }

    function showCitySummary()
    {
        $data = $this->getCityInfos()->filter(function($info){ return $info !== ''; });

        if ($data->count()) {
            return $data->implode(' · ');
        } else {
            return '-';
        }
    }

    function review($key)
    {
        $arr = [];

        foreach ($this->reviewFields as $field) {
            if ($field->meta_key === $key) return $field->meta_value;
        }

        return null;
    }

    function info($key)
    {
        foreach ($this->infoFields as $field) {
            if ($field->meta_key === $key) return $field->meta_value;
        }

        return null;
    }

    function showInfo($key)
    {
        if ($this->info($key) !== null) {
            return $this->info($key);
        } else {
            return '';
        }
    }

    function refreshReviewFields()
    {
        foreach ($this->topic->reviewColumns as $column) {
            $field = \App\ReviewField::where('entity_id', $this->id)
                ->where('meta_key', $column->meta_key)
                ->first();

            if (!$field) {
                $field = new \App\ReviewField();
                $field->entity_id = $this->id;
                $field->meta_key = $column->meta_key;
            }

            $arr = [];

            foreach ($this->reviews as $review) {
                if ($review->value($column->meta_key)) {
                    $arr[] = $review->value($column->meta_key);
                }
            }

            if (count($arr)) {
                $field->meta_value = calculate_median($arr);

                $field->save();
            }
        }
    }

    function showInlineReview()
    {
        return '推薦指數 5.0 &nbsp;·&nbsp; 酒很好喝 5.0 &nbsp;·&nbsp; 氣氛舒服 5.0 &nbsp;·&nbsp; 價格親切 5.0';
    }

    function showLatitude()
    {
        $row = \DB::table('locations')->where('entity_id', $this->id)->first();

        if ($row) return $row->latitude;

        return null;
    }

    function showLongitude()
    {
        $row = \DB::table('locations')->where('entity_id', $this->id)->first();

        if ($row) return $row->longitude;

        return null;
    }

    function setupCoordinate()
    {
        $geo = file_get_contents('https://maps.googleapis.com/maps/api/geocode/json' . '?'. http_build_query([
            'address' => $this->addressForGoogle(),
            'key' => env('GOOGLE_MAP_KEY_UNRESTRICTED')
        ]));

        $geo = json_decode($geo);

        $lat = $geo->results[0]->geometry->location->lat;

        $lng = $geo->results[0]->geometry->location->lng;

        \DB::table('locations')->updateOrInsert(
            [
                'entity_id' => $this->id
            ],
            [
                'latitude' => $lat,
                'longitude' => $lng,
                "created_at" =>  \Carbon\Carbon::now(),
                "updated_at" => \Carbon\Carbon::now(),
            ]
        );
    }

    function entityTags()
    {
        return $this->hasMany('App\EntityTag');
    }

    function getContributors()
    {
        $users = [];

        $users[] = $this->user;

        foreach ($this->editings as $editing) {
            $users[] = $editing->user;
        }

        foreach ($this->reviews as $review) {
            $users[] = $review->user;
        }

        foreach ($this->comments as $comment) {
            $users[] = $comment->user;
        }

        foreach ($this->photos as $photo) {
            $users[] = $photo->user;
        }

        foreach ($this->entityTags as $tag) {
            $users[] = $tag->user;
        }

        $users = collect($users);

        $users = $users->unique('id');

        $users->values();

        return $users;
    }
}
