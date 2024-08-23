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

// Route::get('/', function () {
//     return view('welcome');
// });
Auth::routes();
Route::get('/', 'JobController@index');
Route::get('/import', 'ImportController@index');
Route::post('/uploadFile', 'ImportController@uploadFile');
// Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/jobs/alljobs', 'JobController@alljobs')->name('alljobs');
Route::get('/jobs/search', 'JobController@searchJob');
Route::get('/company/{id}/{company}', 'CompanyController@index')->name('company.index');
Route::get('/blog/index', 'BlogController@index')->name('blog');



Route::group(['middleware' => ('seeker' || 'employer')], function(){

    Route::get('/home', 'HomeController@index')->name('home');
    Route::get('/jobs/alljobs', 'JobController@alljobs')->name('alljobs');
    Route::get('/jobs/search', 'JobController@searchJob');
    Route::get('/company/{id}/{company}', 'CompanyController@index')->name('company.index');

    // Jobs Profile
    Route::get('/jobs/{id}/{job}', 'JobController@show')->name('jobs.show');//dikasih nama job.show sehingga mudah memanggilnya.
    
    Route::get('/jobs/create', 'JobController@create')->name('jobs.create');
    Route::post('/jobs/store', 'JobController@store')->name('jobs.store');
    Route::get('/jobs/myjobs', 'JobController@myjobs')->name('jobs.myjobs');
    Route::post('/jobs/apply/{id}', 'JobController@apply')->name('jobs.apply');
    Route::get('/jobs/applicants', 'JobController@applicants');
    Route::post('/applications/{id}', 'JobController@apply')->name('apply');
    Route::post('/jobs/image', 'JobController@image')->name('jobs.image');
    Route::get('/jobs/{id}/edit', 'JobController@edit')->name('jobs.edit');
    Route::delete('/jobs/{id}', 'JobController@destroy')->name('jobs.destroy');
    Route::post('/jobs/fav', 'JobController@fav')->name('jobs.fav');
    Route::post('/jobs/unvaf', 'JobController@unfav')->name('jobs.unfav');
    
    // Search Jobs With Vue Js


    // Save and Unsave Job
    Route::post('/save/{id}', 'FavoriteController@saveJob');
    Route::post('/unsave/{id}', 'FavoriteController@unSaveJob');


    // Company Profile
    Route::get('/company/create', 'CompanyController@create')->name('company.create'); // untuk employer
    Route::post('/company/store', 'CompanyController@store')->name('company.store');
    Route::post('/company/coverphoto', 'CompanyController@coverphoto')->name('company.coverphoto');
    Route::post('/company/logo', 'CompanyController@logo')->name('company.logo');

    // User Profile
    Route::get('/user/profile', 'UserProfileController@index')->name('user.profile');
    Route::post('/profile/store', 'UserProfileController@store')->name('profile.store');
    Route::post('/profile/coverletter', 'UserProfileController@coverletter')->name('profile.coverletter');
    Route::post('/profile/resume', 'UserProfileController@resume')->name('profile.resume');
    Route::post('/profile/avatar', 'UserProfileController@avatar')->name('profile.avatar');

    // Route::post('/login', 'UserProfileLoginController@login')->middleware('seeker');

    // Employer Profile
    Route::view('/employer/profile', 'auth.emp-register')->name('employer.registration');
    Route::post('/employer/profile/store', 'EmployerProfileController@store')->name('employer.store');

});

// Route::group(['middleware' => 'employer'], function(){

//     Route::get('/jobs/{id}/{job}', 'JobController@show')->name('jobs.show');//dikasih nama job.show sehingga mudah memanggilnya.
        
    
// });
