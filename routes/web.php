<?php

use App\Http\Controllers\admin\GraphController;
use App\Http\Controllers\admin\JalurController;
use App\Http\Controllers\AdminDashboard;
use App\Http\Controllers\UserDashboard;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\admin\OltController as adminolt;
use App\Http\Controllers\admin\OdcController as adminodc;
use App\Http\Controllers\admin\OdpController as adminodp;
use App\Http\Controllers\admin\UserController;

//user
use App\Http\Controllers\user\OltController as userolt;
use App\Http\Controllers\user\OdcController as userodc;
use App\Http\Controllers\user\OdpController as userodp;
use App\Http\Controllers\user\GraphController as graph;
use App\Http\Controllers\user\JalurUsController;

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
    return redirect()->route('login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
Route::group(['middleware' => ['role:admin', 'auth']], function () {
    Route::get('admin', function () {
        return redirect()->route('admindashboard');
    })->name('admin');
    //Dashboard admin
    Route::get('admin/dashboard', [AdminDashboard::class, 'index'])->name('admindashboard');

    //User

    Route::resource('admin/user', UserController::class, [
        'names' => [
            'index' => 'admin.user.index',
            'create' => 'admin.user.create',
            'store' => 'admin.user.store',
            'show' => 'admin.user.show',
            'edit' => 'admin.user.edit',
            'update' => 'admin.user.update',
            'destroy' => 'admin.user.destroy',
        ]
    ]);

    //olt
    Route::resource('admin/olt', adminolt::class, [
        'names' => [
            'index' => 'admin.olt.index',
            'create' => 'admin.olt.create',
            'store' => 'admin.olt.store',
            'show' => 'admin.olt.show',
            'edit' => 'admin.olt.edit',
            'update' => 'admin.olt.update',
            'destroy' => 'admin.olt.destroy',
        ]
    ]);

    //odc
    Route::resource('admin/odc', adminodc::class, [
        'names' => [
            'index' => 'admin.odc.index',
            'create' => 'admin.odc.create',
            'store' => 'admin.odc.store',
            'show' => 'admin.odc.show',
            'edit' => 'admin.odc.edit',
            'update' => 'admin.odc.update',
            'destroy' => 'admin.odc.destroy',
        ]
    ]);
  
    //jalur
    Route::get('admin/jalur/mojogedang', [JalurController::class, 'index'])->name('admin.jalur.index');
    Route::get('admin/jalur/asmil', [JalurController::class, 'asmil'])->name('admin.jalur.asmil');
    
    //odp
    Route::resource('admin/odp', adminodp::class, [
        'names' => [
            'index' => 'admin.odp.index',
            'create' => 'admin.odp.create',
            'store' => 'admin.odp.store',
            'show' => 'admin.odp.show',
            'edit' => 'admin.odp.edit',
            'update' => 'admin.odp.update',
            'destroy' => 'admin.odp.destroy',
        ]
    ]);

    //graph
    Route::get('admin/graph/odc', [GraphController::class, 'index'])->name('admin.graph.odc');
    Route::get('admin/graph/odp', [GraphController::class, 'index2'])->name('admin.graph.odp');
});
Route::group(['middleware' => ['role:user', 'auth']], function () {
    Route::get('user', function () {
        return redirect()->route('userdashboard');
    })->name('user');
    //Dashboard User
    Route::get('user/dashboard', [UserDashboard::class, 'index'])->name('userdashboard');

   //olt
    Route::resource('user/olt', userolt::class, [
        'names' => [
            'index' => 'user.olt.index',
            'show' => 'user.olt.show',       
        ]
    ]);

    //odc
    Route::resource('user/odc', userodc::class, [
        'names' => [
            'index' => 'user.odc.index',
            'show' => 'user.odc.show',       
        ]
    ]);

    //odp
    Route::resource('user/odp', userodp::class, [
        'names' => [
            'index' => 'user.odp.index',
            'show' => 'user.odp.show',       
        ]
    ]);
});


// //jalur
Route::get('user/jalur/mojogedang', [JalurUsController::class, 'mojogedang'])->name('user.jalur.mojogedang');
Route::get('user/jalur/asmil', [JalurUsController::class, 'asmil'])->name('user.jalur.asmil');
// Route::get('/map', function () {
//     File::get(storage_path('app/contoh.kml'));
// });

//graph
Route::get('user/graph/odc', [Graph::class, 'index'])->name('user.graph.odc');
Route::get('user/graph/odp', [Graph::class, 'index2'])->name('user.graph.odp');

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});
