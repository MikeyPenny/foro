<?php

// Routes that does not require authentication.

Route::get('register', [
   'uses' => 'RegisterController@create',
    'as' => 'register'
]);

Route::post('register', [
    'uses' => 'RegisterController@store',
]);

Route::get('register/confirm', [
    'uses' => 'RegisterController@confirm',
    'as' => 'register_confirmation'
]);

Route::get('token', [
   'uses' => 'TokenController@create',
    'as' => 'token',
]);

Route::post('token', [
    'uses' => 'TokenController@store',
]);

Route::get('token/confirmation', [
   'uses' => 'TokenController@confirm',
    'as' => 'login_confirmation',
]);

Route::get('login/{token}', [
   'uses' => 'LoginController@login',
   'as' => 'login',
]);
