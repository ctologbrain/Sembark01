<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ShortUrlController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminMemberController;
use App\Http\Controllers\ShortUrlAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
   $role = Auth::user()->role_id;
   if($role==1)
   {
    return redirect(url('client'));
   }
   if($role==2)
   {
    
     return redirect(url('ShortUrlAdmin'));
   }
   if($role==3)
   {
     return redirect(url('ShortUrlAdmin'));
  
   }
    
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/client', [ClientController::class, 'index'])->name('index');
    Route::get('/clientList', [ClientController::class, 'clientList'])->name('clientList');
    Route::get('/InviteClient', [ClientController::class, 'create'])->name('create');
    Route::post('/PostClient', [ClientController::class, 'store'])->name('PostClient');
    Route::get('/shorturl', [ShortUrlController::class, 'index'])->name('index');
    Route::get('/AdminList', [AdminController::class, 'index'])->name('index');
    Route::get('/AdminListDisplay', [AdminController::class, 'AdminListDisplay'])->name('AdminListDisplay');
    Route::get('/AddAdmin', [AdminController::class, 'create'])->name('create');
    Route::post('/postAdmin', [AdminController::class, 'store'])->name('store');
    Route::get('/AdminAndMemberList', [AdminMemberController::class, 'index'])->name('index');
    Route::get('/AdminAndMemberListDisplay', [AdminMemberController::class, 'AdminAndMemberListDisplay'])->name('AdminAndMemberListDisplay');
    Route::get('/AddAdminAndMember', [AdminMemberController::class, 'create'])->name('create');
    Route::post('/postAdminAndMember', [AdminMemberController::class, 'store'])->name('store');
    Route::get('/ShortUrlAdmin', [ShortUrlAdminController::class, 'index'])->name('index');
    Route::get('/shoturlDetails', [ShortUrlAdminController::class, 'shoturlDetails'])->name('shoturlDetails');
    Route::get('/genrateUrls', [ShortUrlAdminController::class, 'create'])->name('create');
    Route::post('/postShortUrl', [ShortUrlAdminController::class, 'store'])->name('store');
    Route::post('/hitsUrl', [ShortUrlAdminController::class, 'hitsUrl'])->name('hitsUrl');
});

require __DIR__.'/auth.php';
