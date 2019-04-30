<?php

Route::group(['middleware' => ['web'], 'prefix' => 'admin', 'namespace' => 'Themes\Classical\Admin'], function()
{
    Route::get('/', 'GeneralController@index');
});
