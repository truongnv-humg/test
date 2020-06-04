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


Route::get('register', function () {
    return view('frontend.register');
});

Route::post('test', function (\Illuminate\Http\Request $request) {
    return response()->json([
        'status' => 200,
        'data' => $request->all()
    ]);
});