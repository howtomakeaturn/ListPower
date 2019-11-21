<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App;
use URL;
use Carbon\Carbon;
use AppCore;

class SitemapController extends Controller
{
    protected $sitemap;

    public function __construct()
    {
        $this->sitemap = App::make('sitemap');
    }

    public function index(Request $request)
    {
        $this->sitemap->add(URL::to('/'), Carbon::now(), '1.0', 'daily');

        $this->addLists();

        $this->addEntities();

        return $this->sitemap->render('xml');
    }

    public function addLists()
    {
        $topics = \App\Topic::all();

        foreach ($topics as $topic) {
            $this->sitemap->add(URL::to("/list/" . $topic->hashids()), Carbon::now(), '1.0', 'daily');
        }
    }

    public function addEntities()
    {
        $entities = \App\Entity::all();

        foreach ($entities as $entity) {
            $this->sitemap->add(URL::to("/view/" . $entity->hashids()), Carbon::now(), '1.0', 'daily');
        }
    }
}
