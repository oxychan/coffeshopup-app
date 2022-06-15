<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\LoginController;

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

//main route
Route::get('/', [HomeController::class, 'index']);
Route::get('/all-menus', function() {
    return view('user.menus');
})->name('user.menus')->withoutMiddleware(['role:admin', 'role:employee']);



// auth route
Auth::routes(['verify' => true]);
Route::get('logout', [LoginController::class, 'logout']);

// route for buyer
Route::group(['middleware' => ['auth', 'role:buyer']], function() {
    Route::get('/order', function() {
        return view('user.order');
    })->middleware('verified'); // email must verified before accesing this route or page
    Route::get('/chart', function() {
        return view('user.chart');
    })->middleware('verified');
    Route::get('/order', function() {
        return view('user.order-fe');
    })->middleware('verified');
});

// routes for employee
Route::group(['middleware' => ['auth', 'role:employee']], function() {
    Route::prefix('employee')->group( function () {
        Route::get('/', function () {
            return view('employee.staff-dapur.dashboard');
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

// route for staff-dapur
    Route::resource('menu', MenuController::class);
    Route::get('/staff-dapur/dashboard', function () {
            return view('employee.staff-dapur.dashboard');
        });

//route for payment
    Route::resource('payment', PaymentController::class);
    Route::get('/kasir/dashboard', function () {
            return view('employee.kasir.dashboard');
        });
});