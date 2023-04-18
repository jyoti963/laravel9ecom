<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Front\IndexController;

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
//End Update Vendor Details

//Admin Management route
Route::match(['get','post'],'admin-management/{type?}',[AdminController::class,'adminManage']);
//End Admin Management route

//Change status for admin table
Route::post('update-admin-status', [AdminController::class, 'updateStatus'])->name('admin.updateStatus');
//End Change status for admin table

// Section Route
Route::get('sections',[SectionController::class,'section'])->name('admin.sections');
Route::post('section-update-status', [SectionController::class, 'updateSectionStatus'])->name('admin.section.updateStatus');
Route::match(['get','post'],'add-sections-details', [SectionController::class, 'addSection'])->name('admin.add.section');
Route::match(['get','post'],'edit-sections-details/{id}', [SectionController::class, 'editSection'])->name('admin.edit.section');
Route::get('delete-section/{id}', [SectionController::class, 'deleteSection'])->name('admin.delete.section');
//End Section Route

// Category Route
Route::post('category-update-status', [CategoryController::class, 'updateCategoryStatus'])->name('admin.category.updateStatus');
Route::get('category',[CategoryController::class,'index'])->name('admin.category.index');
Route::match(['get','post'],'add-edit-category/{id?}', [CategoryController::class, 'addEditCategory'])->name('admin.add.edit.category');
Route::get('append-category-level',[CategoryController::class,'appendCategoryLevel']);
Route::get('delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('admin.category.delete');
Route::get('delete-category-image/{id}',[CategoryController::class,'deleteCategoryImage']);
// End Category Route

//Brand Route
Route::get('delete-brand/{id}', [BrandController::class, 'destroy']);
Route::get('brand',[BrandController::class,'index'])->name('admin.brand.index');
Route::match(['get','post'],'add-brand', [BrandController::class, 'addBrand'])->name('admin.brand.add');
Route::match(['get','post'],'edit-brand/{id}', [BrandController::class, 'editBrand'])->name('admin.brand.edit');
Route::post('brand-update-status', [BrandController::class, 'updateBrandStatus']);

//End Brand Route

//Product Route
Route::get('product',[ProductController::class,'index'])->name('admin.index.product');
Route::match(['get','post'],'add-edit-product/{id?}', [ProductController::class, 'addEditProduct'])->name('admin.product.add.edit');
Route::post('product-update-status', [ProductController::class, 'updateProductStatus']);
Route::get('delete-product/{id}', [ProductController::class, 'destroy']);
Route::get('delete-product-image/{id}',[ProductController::class,'deleteProductImage']);
Route::get('delete-product-video/{id}',[ProductController::class,'deleteProductVideo']);
//End Product Route

//Attributes Routes
Route::match(['get','post'],'add-edit-attributes/{id}',[ProductController::class,'addAttributes']);
Route::post('attribute-update-status', [ProductController::class, 'updateAttributeStatus']);
Route::match(['get','post'],'edit-attributes/{id}',[ProductController::class,'editAttributes']);
//End Attributes Route

//Images Routes
Route::match(['get','post'],'add-images/{id}',[ProductController::class,'addImage']);
Route::post('image-update-status', [ProductController::class, 'updateImageStatus']);
Route::get('delete-image/{id}',[ProductController::class,'deleteImage']);

//End Images Routes

//Banners Routes
Route::get('banner',[BannerController::class,'index'])->name('admin.banners');
Route::match(['get','post'],'add-banner',[BannerController::class,'addBanner'])->name('admin.addbanner');
Route::match(['get','post'],'edit-banner/{id}',[BannerController::class,'editBanner'])->name('admin.editbanner');
Route::post('banner-update-status', [BannerController::class, 'updateBannerStatus']);
Route::get('delete-banner/{id}',[BannerController::class,'deleteBanner']);


//Admin Logout Route
Route::get('logout',[AdminController::class,'logout'])->name('admin.logout');

});
});
});


//Frontend Routes
Route::get('/',[IndexController::class,'index']);
// Route::get('/phpinfo', function() {
//     return phpinfo();
// });


