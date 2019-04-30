<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Topic;
use App\Entity;
use App\Editing;
use App\Photo;
use Hashids;
use AppCore;

class GeneralController extends Controller
{
    function homepage()
    {
        $topics = Topic::where('status', Topic::STATUS_PUBLIC)->get();

        return view(theme_path('homepage'), compact('topics'));
    }

    function repo(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $topic = Topic::find($id);

        AppCore::setCurrentTab('data');

        $entities = Entity::where('topic_id', $id)->where('status', Entity::STATUS_PUBLIC)->get();

        if ($filter = AppCore::resolveFilter($topic, $request)) {
            AppCore::setCurrentFilter($filter);

            $entities = $entities->filter(function($entity) use ($filter) {
                return $entity->showInfo($filter['column']->meta_key) === $filter['filter'];
            });
        }

        if ($filter && $request->get('map') === '1') {
            AppCore::setOpenGraphTitle($filter['filter'] . ' · 地圖 · ' . $topic->name);
        } else if ($filter && $request->get('map') !== '1') {
            AppCore::setOpenGraphTitle($filter['filter'] . ' · ' . $topic->name);
        } else if (!$filter && $request->get('map') === '1') {
            AppCore::setOpenGraphTitle('地圖 · ' . $topic->name);
        } else {
            AppCore::setOpenGraphTitle($topic->name);
        }

        if ($request->get('map') === '1') {
            AppCore::setCurrentMode('map');

            $locations = [];

            foreach ($entities as $entity) {
                if ($entity->location) $locations[] = $entity->location;
            }

            $center = AppCore::getMapCenter($locations);

            if ($filter === null) $center['zoom'] = 10;

            return view(theme_path('repo'), compact('topic', 'entities', 'center'));
        }

        $entities = $entities->sortByDesc(function($entity) {
            return $entity->tags->count() + $entity->photos->count() + $entity->comments->count() + $entity->reviews->count();
        });

        return view(theme_path('repo'), compact('topic', 'entities'));
    }

    function contributors($id)
    {
        $id = Hashids::decode($id)[0];

        $topic = Topic::find($id);

        $entities = Entity::where('topic_id', $id)->get();

        $contributions = AppCore::getContributions($topic);

        AppCore::setOpenGraphTitle($topic->name);

        return view(theme_path('contributors'), compact('topic', 'contributions'));
    }

    function allContributors()
    {
        $get = new \App\GetContribution();

        $contributions = $get->getContributions();

        return view(theme_path('all-contributors'), compact('contributions'));
    }

    function view($id)
    {
        $id = Hashids::decode($id)[0];

        $entity = Entity::find($id);

        $topic = $entity->topic;

        AppCore::setCurrentTab('data');

        AppCore::setOpenGraphTitle($entity->name);

        return view(theme_path('entity-page'), compact('entity', 'topic'));
    }

    function review($id)
    {
        $id = Hashids::decode($id)[0];

        $entity = Entity::find($id);

        $topic = $entity->topic;

        AppCore::setCurrentTab('data');

        AppCore::setOpenGraphTitle($entity->name);

        return view(theme_path('review'), compact('entity', 'topic'));
    }

    function edit($id)
    {
        $id = Hashids::decode($id)[0];

        $entity = Entity::find($id);

        $topic = $entity->topic;

        AppCore::setCurrentTab('data');

        AppCore::setOpenGraphTitle($entity->name);

        return view(theme_path('edit'), compact('entity', 'topic'));
    }

    function comment($id)
    {
        $id = Hashids::decode($id)[0];

        $entity = Entity::find($id);

        return view(theme_path('comment'), compact('entity'));
    }

    public function submitReview(Request $request)
    {
        $entity = Entity::find($request->get('id'));

        $review = \App\Review::where('entity_id', $entity->id)
            ->where('user_id', Auth::user()->id)
            ->first();

        if (!$review) {
            $review = new \App\Review();

            $review->entity_id = $entity->id;

            $review->user_id = Auth::user()->id;
        }

        $review->save();

        foreach ($entity->topic->reviewColumns as $column) {
            if ($request->get($column->meta_key) === null) continue;

            $cell = \App\ReviewCell::where('review_id', $review->id)
                ->where('meta_key', $column->meta_key)
                ->first();

            if (!$cell) {
                $cell = new \App\ReviewCell();
                $cell->review_id = $review->id;
                $cell->meta_key = $column->meta_key;
            }

            $cell->meta_value = $request->get($column->meta_key);

            $cell->save();
        }

        $review->approve();

        return redirect()->to('/view/' . $entity->hashids())->with('message.title', '送出評分成功！');

        /*
        $title = '評分成功！';

        $text = '系統已收到您的評分，非常謝謝您。';

        return view(theme_path('msg'), compact('title', 'text'));
        */
    }

    function reviews(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $entity = Entity::find($id);

        return view(theme_path('reviews'), compact('entity'));
    }

    function submitComment(Request $request)
    {
        $comment = new \App\Comment();

        $comment->entity_id = $request->get('entity_id');

        $comment->content = $request->get('body');

        $comment->user_id = Auth::user()->id;

        $comment->save();

        return redirect()->back()->with('message.title', '發佈留言成功！');

        /*
        $title = '留言成功！';

        $text = '系統已收到您的留言，非常謝謝您。';

        return view(theme_path('msg'), compact('title', 'text'));
        */
    }

    function submitEdit(Request $request)
    {
        $entity = Entity::find($request->get('id'));

        $diff = [];

        $editing = new \App\Editing();

        if (diff($entity->name, $request->get('name'))) {
            $editing->name = $request->get('name');
        } else {
            $editing->name = '';
        }

        $editing->entity_id = $entity->id;

        $editing->user_id = Auth::user()->id;

        $editing->save();

        foreach ($entity->topic->infoSections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($request->get($column->meta_key) === null) continue;

                if (!diff($entity->showInfo($column->meta_key), $request->get($column->meta_key))) continue;

                $cell = new \App\EditingCell();
                $cell->editing_id = $editing->id;
                $cell->meta_key = $column->meta_key;
                $cell->meta_value = ($request->get($column->meta_key));

                $cell->save();
            }
        }

        $editing->approve();

        return redirect()->to('/view/' . $entity->hashids())->with('message.title', '更新資料成功！');

        /*
        $title = '編輯成功！';

        $text = '系統已收到您編輯的資料，非常謝謝您。';

        return view(theme_path('msg'), compact('title', 'text'));
        */
    }

    function add(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $topic = Topic::find($id);

        AppCore::setOpenGraphTitle($topic->name);

        return view(theme_path('add'), compact('topic'));
    }

    function submitAdd(Request $request)
    {
        $topic = Topic::find($request->get('id'));

        $entity = new Entity();

        $entity->name = $request->get('name');

        $entity->user_id = Auth::user()->id;

        $entity->topic_id = $topic->id;

        $entity->save();

        foreach ($entity->topic->infoSections as $section) {
            foreach ($section->infoColumns as $column) {
                if ($request->get($column->meta_key) === null) continue;

                $field = new \App\InfoField();
                $field->entity_id = $entity->id;
                $field->meta_key = $column->meta_key;
                $field->meta_value = ($request->get($column->meta_key));

                $field->save();
            }
        }

        /*
        $title = '新增成功！';

        $text = '系統已收到您新增的資料，非常謝謝您。';

        return view(theme_path('list-msg'), compact('topic','title', 'text'));
        */

        return redirect()->to('/view/' . $entity->hashids());
    }

    function createList(Request $request)
    {
        if (Auth::check() && Auth::user()->isAdmin()) {
            return view(theme_path('create-list'));
        }
    }

    function submitList(Request $request)
    {
        $topic = new Topic();

        $topic->name = $request->get('title');

        $topic->description = $request->get('description');

        $topic->save();

        $topic->setupReviewColumns($request->get('review-columns-setting-state'));

        $topic->setupInfoColumns($request->get('info-columns-setting-state'));

        $perm = new \App\TopicUser();

        $perm->topic_id = $topic->id;

        $perm->user_id = Auth::user()->id;

        $perm->save();

        $this->addSuperAdmin($topic->id);

        return redirect()->to('/list/' . $topic->hashids());
    }

    function addSuperAdmin($id)
    {
        foreach (config('general.super_admin') as $email) {
            $user = \App\User::where('email', $email)->first();

            if ($user && \App\TopicUser::where('topic_id', $id)->where('user_id', $user->id)->count() === 0) {
                $perm = new \App\TopicUser();

                $perm->topic_id = $id;

                $perm->user_id = $user->id;

                $perm->save();
            }
        }
    }

    function settings(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $topic = Topic::find($id);

        AppCore::setCurrentTab('settings');

        AppCore::setOpenGraphTitle($topic->name);

        return view(theme_path('settings'), compact('topic'));
    }

    function submitSettings(Request $request)
    {
        $topic = Topic::find($request->get('id'));

        $topic->name = $request->get('title');

        $topic->description = $request->get('description');

        $topic->save();

        $topic->setupReviewColumns($request->get('review-columns-setting-state'));

        $topic->setupInfoColumns($request->get('info-columns-setting-state'));

        $title = '更新完成！';

        $text = '系統已經更新清單設定。';

        return view(theme_path('list-msg'), compact('topic','title', 'text'));
    }

    function dashboard(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $topic = Topic::find($id);

        AppCore::setCurrentTab('dashboard');

        AppCore::setOpenGraphTitle($topic->name);

        $entities = Entity::where('topic_id', $id)->get();

        $entities = $entities->filter(function($entity) {
            return $entity->getAddressInfo();
        });

        $entities = $entities->sortByDesc(function($entity) {
            if ($entity->showLatitude() === null) return 999;

            return $entity->showLatitude();
        });

        return view(theme_path('dashboard'), compact('topic', 'entities'));
    }

    function fetchCoordinate(Request $request)
    {
        $entity = Entity::find($request->get('id'));

        $entity->setupCoordinate();

        return redirect()->back();
    }

    function feeds(Request $request, $id)
    {
        $id = Hashids::decode($id)[0];

        $topic = Topic::find($id);

        AppCore::setCurrentTab('feeds');

        $fetch = new \App\FetchFeeds();

        if ($request->get('type') === 'add') {
            AppCore::setCurrentSubTab('add');

            $records = $fetch->fetchAdd($topic);
        } else if ($request->get('type') === 'review') {
            AppCore::setCurrentSubTab('review');

            $records = $fetch->fetchReview($topic);
        } else if ($request->get('type') === 'editing') {
            AppCore::setCurrentSubTab('editing');

            $records = $fetch->fetchEditing($topic);
        } else if ($request->get('type') === 'comment') {
            AppCore::setCurrentSubTab('comment');

            $records = $fetch->fetchComment($topic);
        } else if ($request->get('type') === 'tag') {
            AppCore::setCurrentSubTab('tag');

            $records = $fetch->fetchTag($topic);
        } else if ($request->get('type') === 'photo') {
            AppCore::setCurrentSubTab('photo');

            $records = $fetch->fetchPhoto($topic);
        } else {
            AppCore::setCurrentSubTab('all');

            $records = $fetch->fetchAll($topic);
        }

        $records = paginateCollection($records, 10);

        AppCore::setOpenGraphTitle($topic->name);

        return view(theme_path('feeds'), compact('topic', 'records'));
    }

    function allFeeds(Request $request)
    {
        $fetch = new \App\FetchAllFeeds();

        $records = $fetch->fetchAll(1);

        $records = paginateCollection($records, 10);

        return view(theme_path('all-feeds'), compact('records'));
    }

    function uploadPhoto(Request $request)
    {
        if (config('image_upload.driver') === 'cloudinary') {
            $response = \Cloudder::upload($request->file('image')->getRealPath());

            $res = $response->getResult();

            $photo = new Photo();

            $photo->url = $res['secure_url'];

            $photo->user_id = Auth::user()->id;

            $photo->entity_id = $request->get('entity_id');

            $photo->save();

            return redirect()->back()->with('message.title', '上傳照片成功！');
        } else if (config('image_upload.driver') === 'local_file') {
            $file = $request->file('image');

            $image = \Image::make($file->getRealPath());

            $image->orientate();

            $path = public_path(config('image_upload.local_file.path'));

            $name = uniqid();

            $image->encode('jpg');

            $image->save($path . "/$name.jpg");

            $photo = new Photo();

            $photo->url = url(config('image_upload.local_file.path') . "$name.jpg");

            $photo->user_id = Auth::user()->id;

            $photo->entity_id = $request->get('entity_id');

            $photo->save();

            return redirect()->back()->with('message.title', '上傳照片成功！');
        }
    }

    function submitImport(Request $request)
    {
        $file = $request->file('file');

        $content = \File::get($file->getRealPath());

        $csv = \League\Csv\Reader::createFromString($content);

        $csv->setHeaderOffset(0);

        $header = $csv->getHeader();

        $records = $csv->getRecords();

        return view(theme_path('parse'), compact('header', 'records', 'content'));
    }

    function submitImportReal(Request $request)
    {
        if (!Auth::user()->isAdmin()) {
            dd('error');
        }

        $content = $request->get('content');

        $service = new \App\ImportCsv($content, Auth::user()->id);

        $id = $service->handle();

        $topic = \App\Topic::find($id);

        \DB::table('topic_user')->insert([
            'topic_id' => $id,
            'user_id' => Auth::user()->id
        ]);

        return redirect()->to('/list/' . $topic->hashids());

    }
}
