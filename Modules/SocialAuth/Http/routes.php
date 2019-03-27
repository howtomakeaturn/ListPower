<?php

Route::group(['middleware' => 'web',/*'prefix' => 'socialauth', */ 'namespace' => 'Modules\SocialAuth\Http\Controllers'], function()
{
    Route::get('login', [
      'as' => 'login',
      'uses' => 'SocialAuthController@showLoginForm'
    ]);

    Route::get('/auth/facebook', 'SocialAuthController@auth');

    Route::get('/auth/callback', 'SocialAuthController@callback');

    Route::post('logout', [
        'as' => 'logout',
        'uses' => 'SocialAuthController@logout'
    ]);

    Route::get('/auth/github', 'SocialAuthController@authGithub');

    Route::get('/auth/github/callback', 'SocialAuthController@callbackGithub');

    Route::get('/page/privacy', function () {
        echo '隱私權政策';
        echo '<br>';
        echo '本網站會從 Facebook API 詢問您的名字、Email與照片。';
        echo '<br>';
        echo '本網站會利用這些資訊建立您的個人檔案，也會用來顯示在網站上。';
        echo '<br>';
        echo '本網站也會利用這些資訊建立社群資料，讓大家知道哪些使用者貢獻特別多。';
    });
});
