<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'UserController@home')->name('auth.home')->middleware('auth');
Route::get('/auth-login', 'UserController@login')->name('login');
Route::get('/logout', 'UserController@logout')->name('auth.logout');
Route::post('/auth-login', 'UserController@authenticate')->name('auth.login');
Route::get('/auth-register', 'UserController@register')->name('register');
Route::post('/auth-register', 'UserController@auth_register')->name('auth.register');
Route::get('/forget-password', 'UserController@forget_password')->name('forget.password');
Route::post('/auth-forget-password', 'UserController@auth_forget_password')->name('auth.forget.password');
Route::get('/reset-password/{id}/user', 'UserController@reset_password')->name('reset.password');
Route::post('/reset-password', 'UserController@auth_reset_password')->name('auth.reset.password');