<?php

// Routes that does not require authentication.

Route::get('register', [
   'uses' => 'RegisterController@create',
    'as' => 'register'
]);

Route::post('register', [
    'uses' => 'RegisterController@store',
    'as' => 'store'
]);

Route::get('register/confirm', [
    'uses' => 'RegisterController@confirm',
    'as' => 'register_confirmation'
]);

Route::get('login', [
   'uses' => 'LoginController@create',
    'as' => 'login',
]);

Route::post('login', [
    'uses' => 'LoginController@store',
]);

Route::get('login/confirmation', [
   'uses' => 'LoginController@confirm',
    'as' => 'login_confirmation',
]);
