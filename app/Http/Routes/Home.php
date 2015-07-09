<?php

Route::get(
    '/',
    [
        'as' => 'home.getIndex',
        'uses' => 'HomeController@index'
    ]
);
Route::post(
    '/search',
    [
        'as' => 'home.search',
        'uses' => 'HomeController@search'
    ]
);
Route::get(
    '/user/{id}',
    [
        'as' => 'user.profile',
        'uses' => 'HomeController@user'
    ]
);