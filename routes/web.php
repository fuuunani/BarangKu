<?php

Route::get('/', function () {
    return redirect('login');
});

Route::get('login', 'DefaultController@index')->name('login');
Route::get('logout', 'DefaultController@logout')->name('logout');
Route::get('post/login', 'DefaultController@login')->name('login.post');
Route::get('register', 'DefaultController@register')->name('register');
Route::post('post/register', 'DefaultController@registerPost')->name('register.post');
Route::get('profile/{pengguna}', 'DefaultController@profile')->name('profile');
Route::post('post/profile', 'DefaultController@profileUpdate')->name('profile.post');
Route::get('dashboard', 'DefaultController@dashboard')->name('dashboard');
Route::get('data/barang', 'BarangController@data')->name('data.barang');
Route::get('data/pengguna', 'PenggunaController@data')->name('data.pengguna');
Route::resource('barang', 'BarangController');
Route::resource('pengguna', 'PenggunaController');