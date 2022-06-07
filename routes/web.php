<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;

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
    return view('indAdm');
});

Route::get('/', [MenuController::class, 'index']);

Route::resource('menu', MenuController::class);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::view('/order', 'order')->middleware('verified'); // email must verified before accesing this route or page

// routes for employee
Route::prefix('employee')->group( function () {
    Route::get('/', function () {
        return view('indexAdm');
    });
    Route::get('/ui-features/buttons', function () {
        return view('employee.ui-features.buttons');
    });
    Route::get('/ui-features/typography', function () {
        return view('employee.ui-features.typography');
    });
    Route::get('/icons/mdi', function () {
        return view('employee.icons.mdi');
    });
    Route::get('/forms/basic_elements', function () {
        return view('employee.forms.basic_elements');
    });
    Route::get('/charts/chartjs', function () {
        return view('employee.charts.chartjs');
    }); 
    Route::get('/tables/basic-table', function () {
        return view('employee.tables.basic-table');
    }); 
    Route::get('/samples/blank-page', function () {
        return view('employee.samples.blank-page');
    }); 
    Route::get('/samples/login', function () {
        return view('employee.samples.login');
    }); 
    Route::get('/samples/register', function () {
        return view('employee.samples.register');
    }); 
    Route::get('/samples/error-500', function () {
        return view('employee.samples.error-500');
    }); 
    Route::get('/samples/error-404', function () {
        return view('employee.samples.error-404');
    }); 
});