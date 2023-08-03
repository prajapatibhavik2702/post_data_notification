<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserDetailsController;
use App\Http\Controllers\PostNotificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');


    Route::get('/users/create-notification', [UserController::class, 'create'])->name('message.create');


    Route::get('/users/{user}/messages', [UserController::class, 'show'])->name('users.messages.show');


    Route::post('/users/add-notification', [UserController::class, 'store'])->name('users.addNotification');
    Route::post('/users/update-notification-status', [UserController::class, 'updateNotificationStatus'])->name('users.updateNotificationStatus');



                            ///      user deatils controller ///
    Route::get('/userdetails/{userId}', [UserDetailsController::class, 'index'])->name('user.settings');

    Route::Post('/userdetails/{id}', [UserDetailsController::class, 'update'])->name('user.settings.update');




                              /////   post mate route    ///

    Route::get('/notifications/create', [PostNotificationController::class, 'create'])->name('posts.create');

    Route::post('/notifications', [PostNotificationController::class, 'store'])->name('posts.store');

    Route::get('/shownotification', [PostNotificationController::class, 'show'])->name('posts.show');

    Route::get('/usernotificationdetails{id}', [PostNotificationController::class, 'userview'])->name('user.notification.detail');

    Route::post('/mark-notification-read/{notification}', [PostNotificationController::class,'markNotificationRead'])->name('mark-notification-read');

    Route::get('/notifications/search', [PostNotificationController::class,'search'])->name('notifications.search');

});

require __DIR__.'/auth.php';




