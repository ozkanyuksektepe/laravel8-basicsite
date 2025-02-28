<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Multipicture;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ChangePassController;
use App\Http\Controllers\UserProfileController;

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

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $images = Multipicture::all();
    return view('home', compact('brands','abouts', 'images'));
});

                                //          CATEGORY          //
Route::get('/category/all',[CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add',[CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}',[CategoryController::class, 'Edit']);
Route::post('/category/update/{id}',[CategoryController::class, 'Update']);
Route::get('softdelete/category/{id}',[CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}',[CategoryController::class, 'Restore']);
Route::get('pdelete/category/{id}',[CategoryController::class, 'PDelete']);

///////                    BRAND             /////////////
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}',[BrandController::class, 'Edit']);
Route::post('/brand/update/{id}',[BrandController::class, 'Update']);
Route::get('/brand/delete/{id}',[BrandController::class, 'Delete']);

////////////////////////////      MULTİ IMAGE       //////////////////////////////////
Route::get('/multi/image', [BrandController::class, 'Multipicture'])->name('multi.image');
Route::post('/multi/add',[BrandController::class, 'StoreImage'])->name('store.image');

/////////////////////////////// SLİDER /////////////////////////////////////////////
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');

//////////////////////////////// ABOUT ///////////////////////////////////////////////
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);
Route::post('/update/about/{id}', [AboutController::class, 'UpdateAbout']);
Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']);

//////////////////////////////// PORTFOLIO ///////////////////////////////////////////////
Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');

//////////////////////////////// CONTACT ///////////////////////////////////////////////
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');
Route::post('/admin/store/about', [ContactController::class, 'StoreContact'])->name('store.contact');
/// Home Contact Route
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');
Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('/message/delete/{id}', [ContactController::class, 'DeleteMessage']);

//////////////////////////////// CHANGE PASSWORD ///////////////////////////////////////////////
Route::get('/user/password', [ChangePassController::class, 'ChangePassword'])->name('change.password');
Route::post('/password/update', [ChangePassController::class, 'UpdatePassword'])->name('password.update');

//////////////////////////////// USER PROFİLE ///////////////////////////////////////////////
Route::get('/user/profile', [UserProfileController::class, 'ProfileUpdate'])->name('profile.update');
Route::post('/profile/update', [UserProfileController::class, 'UserProfileUpdate'])->name('user.profile.update');













Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //$users = User::all();
    //$users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');

Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');

