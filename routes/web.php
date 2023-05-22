<?php

use App\models\Listing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PhpParser\Node\Expr\Cast\String_;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

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

//All Listings

Route::get('/', [ListingController::class, 'index']);



//show Create form
Route::get('/listings/create', [ListingController::class, 'create'])->middleware('auth');



//Store listings data
Route::post('/listings', [ListingController::class, 'store'])->middleware('auth');


//show Edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->middleware('auth');

//Update listings
Route::put('/listings/{listing}', [ListingController::class, 'update'])->middleware('auth');

//Delete listings
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->middleware('auth');


// manage listings
Route::get('/listings/manage',[ListingController::class,'manage'])->middleware('auth');


//single listing
Route::get('/listings/{listing}', [ListingController::class,'show'])->middleware('auth');


//Show Register/Create Form
Route::get('/register',[UserController::class,'create'])->middleware('guest');


//create New User
Route::post('/users',[UserController::class,'store']);

//Log out a user
Route::post('/logout',[UserController::class,'logout'])->middleware('auth');

//Show login form
Route::get('/login',[UserController::class,'login'])->name('login')->middleware('guest');

//Login User
Route::post('/users/authenticate',[UserController::class,'authenticate']);





//common Resource routes
//index - Show all listings
//show - showing single listing
//create - showing form for creating new listing
//store - for storing new listing
///edit - shows edit form for listing
//update - updating the edited listing
//destroy - deleting a listing
