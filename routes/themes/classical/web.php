<?php

Route::group(['middleware' => ['web', 'admin'], 'prefix' => 'admin', 'namespace' => 'Themes\Classical\Admin'], function()
{
    Route::get('/', 'GeneralController@index');
});
