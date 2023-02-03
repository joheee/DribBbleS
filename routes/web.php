<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FlowController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FlowController::class,'index'])->name('index');
Route::get('search-by-tag/{TagName}', [PostController::class,'handleSearchTag'])->name('user.searchByTag');
Route::get('search-post', [PostController::class, 'handleSearchQuery'])->name('user.searchByInput');
Route::get('post-detail/{id}', [PostController::class, 'showPostDetail'])->name('user.postDetail');

Route::middleware('isGuest')->group(function() {
    Route::get('login',[UserController::class,'loginView'])->name('guest.login');
    Route::post('login-user',[UserController::class, 'login'])->name('guest.loginUser');
    Route::get('register', [UserController::class, 'registerView'])->name('guest.register');
    Route::post('register-new-user', [UserController::class, 'store'])->name('guest.registerNewUser');
});

Route::middleware('auth')->group(function() {
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::patch('profile-user-picture', [UserController::class, 'updatePicture'])->name('user.updateUserPicture');
    Route::patch('profile-user-detail', [UserController::class, 'updateUserDetail'])->name('user.updateUserDetail');
    Route::post('logout-user',[UserController::class,'logout'])->name('user.logout');
});

Route::middleware(['auth','isAdmin'])->group(function() {
    Route::get('admin-delete-post/{id}', [AdminController::class, 'deletePost'])->name('admin.deletePost');
    Route::get('admin-active-user/{id}', [AdminController::class, 'activeUser'])->name('admin.activeUser');
});

Route::middleware(['auth', 'isUser'])->group(function() {
    Route::get('upload', [PostController::class,'viewCreatePost'])->name('user.upload');
    Route::post('upload-new-post', [PostController::class,'createNewPost'])->name('user.uploadNewPost');
    Route::get('post-like/{id}', [PostController::class, 'handleLikes'])->name('post.like');
});




