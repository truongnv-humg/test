<?php
Route::get('/login', "UserController@formLogin")->name('login');
Route::post('/login', "UserController@login")->name('login.action');

Route::get('/', function() {
    return redirect(route("login"));
});
Route::get('/role', "RoleController@index")->name('role.index')->middleware('auth');
Route::post('/role', "RoleController@store")->name('role.add');
Route::get('/role/data', "RoleController@getRoleData")->name('role.get');
Route::get('/permission/create', "RoleController@addPermission")->name('permission.create');
Route::get('/permission', "RoleController@getPermissionByRole")->name('permission.get');
Route::post('/permission/assign', "RoleController@assignPermissionRole")->name('permission.assign');

Route::group(['prefix' => 'post', 'as' => 'post.'], function () {
    Route::get("/", "PostController@index")->name("index");
    Route::get("/add", "PostController@formAdd")->name("add");
    Route::post("/store", "PostController@store")->name("store");
});

Route::group(['prefix' => 'media', 'as' => 'media.'], function () {
    Route::get("/", "MediaController@view")->name("index");
    Route::get('/create', 'MediaController@create')->name('create');
    Route::post('/store', 'MediaController@store')->name('store');
    Route::post('/upload', 'MediaController@uploadImage')->name('upload');
});

