<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/test-message', function() {
    return redirect()->to('/')
        ->with('message.title', '上傳照片成功！')
        ->with('message.description', '系統已收到您上傳的照片，非常謝謝您。');
});

Route::get('/import', function() {
    if (!Auth::user()->isAdmin()) {
        dd('error');
    }

    return view(theme_path('import'));
});

Route::post('/import', 'GeneralController@submitImport');

Route::post('/submit-import', 'GeneralController@submitImportReal');

Route::get('/a-very-secret-really-dangerous-url-for-testing', function() {
    if (env('APP_ENV') !== 'local') {
        dd('error');
    }

    Auth::loginUsingId(1);
});

Route::get('/dd', function () {
    $topics = App\Topic::all();

    return view(theme_path('dd'), compact('topics'));
});

Route::get('/ss', function () {
    echo '<div style="word-wrap: break-word;">';

    for ($i=0; $i < 1000; $i++) {
        echo Hashids::encode($i);
        echo '&nbsp;';
        echo '&nbsp;';
    }

    echo '</div>';
});

Route::get('/about', function () {
    return view(theme_path('about'));
});

Route::get('/', 'GeneralController@homepage');

Route::get('/list/{id}', 'GeneralController@repo');

Route::get('/contributors/{id}', 'GeneralController@contributors');

Route::get('/contributors', 'GeneralController@allContributors');

Route::get('/view/{id}', 'GeneralController@view');

Route::get('/review/{id}', 'GeneralController@review')->middleware('auth');

Route::get('/edit/{id}', 'GeneralController@edit')->middleware('auth');

Route::get('/comment/{id}', 'GeneralController@comment');

Route::post('/submit-review', 'GeneralController@submitReview');

Route::post('/submit-comment', 'GeneralController@submitComment');

Route::post('/submit-edit', 'GeneralController@submitEdit');

Route::get('/reviews/{id}', 'GeneralController@reviews');

Route::get('/add/{id}', 'GeneralController@add')->middleware('auth');

Route::post('/submit-add', 'GeneralController@submitAdd');

Route::get('/create-list', 'GeneralController@createList')->middleware('auth');

Route::post('/submit-list', 'GeneralController@submitList');

Route::get('/settings/{id}', 'GeneralController@settings')->middleware('auth');

Route::post('/submit-settings', 'GeneralController@submitSettings');

Route::get('/dashboard/{id}', 'GeneralController@dashboard')->middleware('auth');

Route::get('/tag/{id}', 'TagController@edit')->middleware('auth');

Route::post('/tag/new-tag', 'TagController@newTag');

Route::post('/tag/apply-tag', 'TagController@applyTag');

Route::post('/tag/unapply-tag', 'TagController@unapplyTag');

Route::get('/feeds/{id}', 'GeneralController@feeds');

Route::get('/feeds', 'GeneralController@allFeeds');

Route::post('/upload-photo', 'GeneralController@uploadPhoto');

Route::post('/fetch-coordinate', 'GeneralController@fetchCoordinate');

Route::prefix('ui')->group(function () {
    Route::get('/', function () {
        return view(theme_path('ui/welcome'));
    });

    Route::get('/{name}', function ($name) {
        return view("ui/$name");
    });
});
