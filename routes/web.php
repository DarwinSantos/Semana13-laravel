<?php
//Darwin Santos
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/login',function(){
//     return view('contacts.login');
// });

Route::resource('contacts', 'ContactController');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
