<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hashids;

class Topic extends Model
{
    const STATUS_PUBLIC = 0;
    const STATUS_SEMI_PUBLIC = 10;

    function users()
    {
        return $this->belongsToMany('App\User');
    }

    function hashids()
    {
        return Hashids::encode($this->id);
    }

    function reviewColumns()
    {
        return $this->hasMany('App\ReviewColumn');
    }

    function sortedReviewColumns()
    {
        return $this->reviewColumns->sortBy('weight');
    }

    function infoSections()
    {
        return $this->hasMany('App\InfoSection');
    }

    function sortedInfoSections()
    {
        return $this->infoSections->sortBy('id');
    }

    function generateReviewColumnsJson()
    {
        $data = [];

        foreach ($this->sortedReviewColumns() as $column) {
            $data[] = [
                'key' => $column->meta_key,
                'label' => $column->meta_label,
            ];
        }

        return json_encode($data);
    }

    function generateInfoSectionsJson()
    {
        $data = [];

        foreach ($this->sortedInfoSections() as $section) {
            $columns = [];

            foreach ($section->sortedInfoColumns() as $column) {
                $columns[] = [
                    'key' => $column->meta_key,
                    'type' => $column->meta_type,
                    'label' => $column->meta_label,
                ];
            }

            $data[] = [
                'key' => $section->meta_key,
                'label' => $section->meta_label,
                'columns' => $columns,
            ];

        }

        return json_encode($data);
    }

    function reviewColumnLabels()
    {
        $result = [];

        foreach ($this->reviewColumns as $column) {
            $result[] = $column->meta_label;
        }

        return $result;
    }

    function entityCount()
    {
        return Entity::where('topic_id', $this->id)->count();
    }

    function reviewCount()
    {
        return \DB::table('reviews')
            ->join('entities', 'reviews.entity_id', 'entities.id')
            ->where('entities.topic_id', $this->id)
            ->count();
    }

    function commentCount()
    {
        return \DB::table('comments')
            ->join('entities', 'comments.entity_id', 'entities.id')
            ->where('entities.topic_id', $this->id)
            ->count();
    }

    function tagCount()
    {
        return \DB::table('entity_tag')
            ->join('entities', 'entity_tag.entity_id', 'entities.id')
            ->where('entities.topic_id', $this->id)
            ->count();
    }

    function hasCityColumn()
    {
        foreach ($this->infoSections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($column->meta_type === 'city') return true;
            }
        }

        return false;
    }

    function hasAddressColumn()
    {
        foreach ($this->infoSections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($column->meta_type === 'address') return true;
            }
        }

        return false;
    }

    function getFirstCityColumn()
    {
      foreach ($this->infoSections as $section) {
          foreach ($section->infoColumns as $column) {
              if ($column->meta_type === 'city') return $column;
          }
      }

      return null;
    }

    function getValidCityNames()
    {
        $result = [];

        foreach (config('city') as $city) {
            $has = \DB::table('info_fields')
                ->where('meta_key', $this->getFirstCityColumn()->meta_key)
                ->where('meta_value', $city)
                ->count();

            if ($has) $result[] = $city;
        }

        return $result;
    }

    function setupReviewColumns($json)
    {
        $data = json_decode($json);

        // delete all legacy columns
        foreach ($this->reviewColumns as $column) {
            $inData = false;

            foreach ($data as $d) {
                if ($column->meta_key === $d->key) {
                    $inData = true;
                }
            }

            if (!$inData) $column->delete();
        }

        // insert & update columns
        foreach ($data as $index => $d) {
            $column = ReviewColumn::where('topic_id', $this->id)
                ->where('meta_key', $d->key)
                ->first();
            if (!$column) {
                $column = new ReviewColumn();
                $column->topic_id = $this->id;
                $column->meta_key = $d->key;
                $column->weight = $index;
            }

            $column->meta_label = $d->label;
            $column->weight = $index;

            $column->save();
        }
    }

    function setupInfoColumns($json)
    {
        $data = json_decode($json);

        // delete all legacy sections
        foreach ($this->infoSections as $section) {
            $inData = false;

            foreach ($data as $s) {
                if ($section->meta_key === $s->key) {
                    $inData = true;
                }
            }

            if (!$inData) $section->clear();
        }

        foreach ($data as $s) {
            $isNew = true;

            foreach ($this->infoSections as $section) {
                if ($section->meta_key === $s->key) {
                    $isNew = false;
                }
            }

            if ($isNew) { // insert new sections
                $section = new InfoSection();
                $section->topic_id = $this->id;
                $section->meta_key = $s->key;
            } else { // update sections
                $section = InfoSection::where('topic_id', $this->id)
                    ->where('meta_key', $s->key)
                    ->first();
            }

            $section->meta_label = $s->label;
            $section->save();

            $section->setupColumns($s->columns);
        }
    }

    function getRecentContributors()
    {
        $rows = \DB::table('entities')
            ->where('topic_id', $this->id)
            ->distinct('user_id')
            ->orderBy('created_at', 'desc')
            ->get();

        $users = User::findMany($rows->pluck('user_id'));

        $users = $users->sortByDesc('created_at');

        return $users;
    }
}
