<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
Route::prefix('admin/')->group(function(){
Route::group(['middleware' => ['back-page-disabled']], function() {
//Admin login Route
Route::match(['get','post'],'login',[AdminController::class,'login'])->name('admin.login');
Route::group(['middleware' => ['admin']], function() {
    //Admin Dashboard Route
Route::get('dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard');
//Update Admin Password
Route::match(['get', 'post'], 'update-admin-password', [AdminController::class,'updateAdminPass'])->name('update.admin.password');
//check admin password
Route::post('check-current-password', [AdminController::class,'checkCurrentPassword']);
//Update Admin Details
Route::match(['get', 'post'], 'update-admin-details', [AdminController::class,'updateAdminDtls'])->name('update.admin.details');

//Update Vendor Details
Route::match(['get', 'post'],'update-vendor-details/{slug}', [AdminController::class,'updateVendorDtls']);
Route::get('view-vendor-details/{id}', [AdminController::class,'viewVendorDtls']);

//Admin Management route
Route::match(['get','post'],'admin-management/{type?}',[AdminController::class,'adminManage']);
//Change status for admin table
Route::get('update-status/{id}', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');

//Admin Logout Route
Route::get('logout',[AdminController::class,'logout'])->name('admin.logout');
});
});
});
// Route::get('/phpinfo', function() {
//     return phpinfo();
// });


