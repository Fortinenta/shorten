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

Route::get('/shorten', "rabrawController@index");

Route::get("/show/{halaman}",[
    "uses" => "rabrawController@show",
    "as" => 'halaman'
]);

Route::get("/page/{page}","rabrawController@page");

Route::get("/tambah", function(){
    return view('tambah');
});

Route::post("/tambah_url","rabrawController@tambah_url");

Route::get("/paging/{paging}","rabrawController@paging");

Route::get("/short/{link}","rabrawController@short");

Route::get("/delete_link/{short}","rabrawController@delete_link");

Route::post("/search","rabrawController@search");
