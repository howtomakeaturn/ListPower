<?php

namespace App\Http\Controllers\Themes\Classical\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;

class GeneralController extends Controller
{
    function index()
    {
        return view('themes.classical.admin.index');
    }
}
