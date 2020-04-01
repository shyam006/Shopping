<?php

use Illuminate\Support\Facades\Route;

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
// ---- Before Login ----\\
Route::get('/','Home@index');
Route::post('/check_login','Home@checkLogin');
Route::get('/logout','Home@logout');

// ---- Dashboard ----\\
Route::get('Dashboard', function () {
    return view('welcome');
});

// ---- Category ---- \\
Route::get('/Category','Category@index');
Route::post('/add_new_cate','Category@add_cate');
Route::get('/Edit_Category/{id}','Category@edit_cate');
Route::post('/save_edited/{id}','Category@edited');
Route::post('/Delete_cate/{id}','Category@delete');

// ---- Sub Category ---- \\
Route::get('/SubCategory','SubCategory@index');
Route::post('/add_new_subcate','SubCategory@add_cate');
Route::get('/Edit_SubCategory/{id}','SubCategory@edit_cate');
Route::post('/save_edited_subcate/{id}','SubCategory@edited');
Route::get('/Delete_subcate/{id}','SubCategory@delete');

// ---- Specification ---- \\
Route::get('/Specification','Specification@index');
Route::post('/add_new_spec','Specification@add_spec');
Route::get('/get_cate_spec/{id}','Specification@get_cate_spec');
Route::get('/Edit_Specification/{id}','Specification@edit_cate_spec');
Route::post('/save_edited_spec/{id}','Specification@edited');
Route::get('/Delete_spec/{id}','Specification@delete');

// ---- Product ---- \\
Route::get('/Product','Product@index');
Route::get('/Add_Product','Product@new');
Route::get('/get_subcate/{id}','Product@get_subcate');
Route::post('/add_new_product','Product@add');



Route::get('blade', function () {
    return view('child');
});
