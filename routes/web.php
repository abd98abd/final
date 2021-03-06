<?php

use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('dashboard');
});

Route::group(['middleware'=>['guest']],function(){

    Route::get('/',function(){


        return view('auth.login');

        });


});


Auth::routes();






Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth' ]
    ], function(){ //...


        Route::get('/dashboard', function()
        {
              return view('dashboard');
        });

        Route::group(['namespace'=>'Grade'],function(){


            Route::resource('grades','GradeController');



        });

        Route::group(['namespace'=>'ClassRoom'],function(){


            Route::resource('classroom','ClassroomController');

            Route::post('delete_all', 'ClassroomController@delete_all')->name('delete_all');

            Route::post('Filter_Classes', 'ClassroomController@Filter_Classes')->name('Filter_Classes');


        });


        Route::group(['namespace'=>'Sections'],function(){


            Route::resource('Sections', 'SectionController');

            Route::get('/classes/{id}', 'SectionController@getclasses');


        });

        Route::group(['namespace'=>'Teachers'],function(){


           Route::resource('Teachers','TeacherController');


        });

        Route::view('add_parent','livewire.show_Form')->name('add_parent');

    });













//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
