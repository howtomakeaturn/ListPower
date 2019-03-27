<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Auth;
use App\Entity;
use App\Tag;
use App\EntityTag;
use Hashids;
use AppCore;

class TagController extends Controller
{

    public function edit(Request $request, $id)
    {
        /*
        HavaCore::setupTopicBySlug($topic);

        $entity = Entity::find($id);

        $query = new \Modules\HavaCore\Tag\Query();

        $userTags = $query->getAllByUserOnEntity(Auth::user(), $entity);

        $userOtherTags = $query->getAllByUserNotOnEntity(Auth::user(), $entity);

        $otherTags = $query->getAllByNotUserNotOnEntity(Auth::user(), $entity);

        return view('havacore::tag/edit', compact('entity', 'userTags', 'userOtherTags', 'otherTags'));
        */
        $id = Hashids::decode($id)[0];

        $entity = Entity::find($id);

        $query = new \App\Tag\Query();

        $userTags = $query->getAllByUserOnEntity(Auth::user(), $entity);

        $userOtherTags = $query->getAllByUserNotOnEntity(Auth::user(), $entity);

        $otherTags = $query->getAllByNotUserNotOnEntity(Auth::user(), $entity);

        AppCore::setOpenGraphTitle($entity->name);

        AppCore::setCurrentTab('data');

        $topic = $entity->topic;

        return view('tag/edit', compact('entity', 'userTags', 'userOtherTags', 'otherTags', 'topic'));
    }

    function newTag(Request $request)
    {
        if (trim($request->get('tag_name')) === '') {
            return 'Please fill in the tag name.';
        }

        $tag = Tag::manualAdd($request->get('tag_name'), $request->get('topic_id'));

        $entityTag = new EntityTag();

        $entityTag->entity_id = $request->get('entity_id');

        $entityTag->tag_id = $tag->id;

        $entityTag->user_id = Auth::user()->id;

        $entityTag->save();

        return redirect()->back();
    }

    function applyTag(Request $request)
    {
        $entityTag = new EntityTag();

        $entityTag->entity_id = $request->get('entity_id');

        $entityTag->tag_id = $request->get('tag_id');

        $entityTag->user_id = Auth::user()->id;

        $entityTag->save();

        return redirect()->back();
    }

    function unapplyTag(Request $request)
    {
        $entityTag = EntityTag::where('entity_id', $request->get('entity_id'))
            ->where('tag_id', $request->get('tag_id'))
            ->where('user_id', Auth::user()->id)
            ->delete();

        return redirect()->back();
    }
}
