<?php

use Illuminate\Support\Facades\Route;
use App\Models\User; // must use for ORM Format
use App\Models\Multipic;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ChangePass;
use Illuminate\Support\Facades\DB; // must use for query builder

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
    $images = Multipic::all();

    return view('home',compact('brands','abouts', 'images'));
})->name('home');



//*********** Category Controller************\\

Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');

Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');

Route::get('/category/edit/{id}', [CategoryController::class, 'Edit']);

Route::post('/category/update/{id}', [CategoryController::class, 'Update']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);

Route::get('/category/restore/{id}', [CategoryController::class, 'Restore']);

Route::get('delete/category/permanently/{id}', [CategoryController::class, 'Pdelete']);


//*********** Brand Controller************\\

Route::get('/brand/all', [BrandController::class, 'Allbrand'])->name('all.brand');

Route::post('/brand/store', [BrandController::class, 'StoreBrand'])->name('store.brand');

Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);

Route::post('/brand/update/{id}', [BrandController::class, 'Update']);

Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


//*************** Multi Image Route *****************/

Route::get('/multi/image', [BrandController::class, 'Multipic'])->name('multi.image');

Route::post('/multi/add', [BrandController::class, 'StoreImg'])->name('store.image');



/////////Admin All Routes\\\\\\\\\\\\\\

Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');

Route::post('/slider/add', [HomeController::class, 'StoreSlider'])->name('store.slider');

Route::get('/add/slider', [HomeController::class, 'Addslider'])->name('add.slider');

Route::get('/slider/edit/{id}', [HomeController::class, 'Edit']);

Route::post('/slider/update/{id}', [HomeController::class, 'Update']);

Route::get('/slider/delete/{id}', [HomeController::class, 'Delete']);

//Home About section


Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');

Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');

Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');


Route::get('/about/edit/{id}', [AboutController::class, 'EditAbout']);

Route::post('/update/homeabout/{id}', [AboutController::class, 'UpdateAbout']);

Route::get('/about/delete/{id}', [AboutController::class, 'DeleteAbout']); 


// Portfolio Section

Route::get('/portfolio', [AboutController::class, 'Portfolio'])->name('portfolio');



// admin contact section
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');

Route::get('/admin/add/contact', [ContactController::class, 'AdminAddContact'])->name('add.contact');


Route::post('/admin/store/contact', [ContactController::class, 'AdminStoreContact'])->name('store.contact');

Route::get('/contact/edit/{id}', [ContactController::class, 'EditAdminContact']);

Route::get('/contact/delete/{id}', [ContactController::class, 'DeleteAdminContact']);

Route::post('/admin/update/contact/{id}', [ContactController::class, 'AdminContactUpdate'])->name('contact.update');



// Homme Contact page route fontend

Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');

Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');

Route::get('/admin/message', [ContactController::class, 'AdminMessage'])->name('admin.message');


Route::get('/message/delete/{id}', [ContactController::class, 'Delete']);













Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {

   // $users = User::all(); //ORM Format data pull from database

    // $users = DB::table('users')->get();  // query builder

return view('admin.index');
})->name('dashboard');


Route::get('user/logout', [BrandController::class, 'Logout'])->name('user.logout');

/// change password and user profile


Route::get('/user/password', [ChangePass::class, 'CPassword'])->name('change.password');

Route::post('/password/update', [ChangePass::class, 'UpdatePassword'])->name('password.update');

// User profile Route

Route::get('/user/profile', [ChangePass::class, 'PUpdate'])->name('profile.update');

Route::post('/user/profile/update', [ChangePass::class, 'UpdateProfile'])->name('update.user.profile');