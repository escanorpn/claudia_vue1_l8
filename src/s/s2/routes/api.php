<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\IgController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/new_register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    // Route::get('/user-profile', [AuthController::class, 'userProfile']);    
});
Route::group(['middleware' => ['jwt.verify'],
'prefix' => 'auth'], function() {
    Route::get('/user-profile2', [AuthController::class, 'userProfile']);
    
    Route::post('/product', [ProductController::class, 'addProduct2']); 
    Route::delete('/product/{id}', [ProductController::class, 'destroy']);

    Route::post('/company', [CompanyController::class, 'addCompany']); 
    Route::delete('/company/{id}', [CompanyController::class, 'destroy']);

    Route::post('/service', [ServiceController::class, 'addService']);
    Route::delete('/service/{id}', [ServiceController::class, 'destroy']);

    Route::post('/project', [ProjectController::class, 'addProject']);
    Route::delete('/project/{id}', [ProjectController::class, 'destroy']);

    Route::post('/blog', [BlogController::class, 'create']);
    Route::delete('/blog/{id}', [BlogController::class, 'destroy']);

    Route::post('/srecipe', [RecipeController::class, 'searchRecipe']);
    Route::post('/recipe', [RecipeController::class, 'addRecipe']);
    Route::delete('/recipe/{id}', [RecipeController::class, 'destroy']);
    
    
Route::get('/company', [CompanyController::class, 'index']);
Route::get('/service', [ServiceController::class, 'index']); 
Route::get('/product', [ProductController::class, 'index']); 
Route::get('/project', [ProjectController::class, 'index']);
Route::get('/recipe', [RecipeController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);

Route::post('/quiz', [QuizController::class, 'update']);
Route::get('/quiz', [QuizController::class, 'index']);

Route::post('/recipe1', [RecipeController::class, 'index']);

});

Route::get('/company', [CompanyController::class, 'index']);
Route::get('/company_limited', [CompanyController::class, 'index_limited']);
Route::get('/service', [ServiceController::class, 'index']); 
Route::get('/product', [ProductController::class, 'index']);
Route::get('/product_limited', [ProductController::class, 'index_limited']);
Route::get('/project', [ProjectController::class, 'index']);
Route::get('/recipe', [RecipeController::class, 'index1']);
Route::post('/recipe', [RecipeController::class, 'index']);
Route::post('/srecipe', [RecipeController::class, 'searchRecipe']);
Route::post('/frecipe', [RecipeController::class, 'filtered']);
Route::get('/quiz', [QuizController::class, 'index']);
Route::get('/blog', [BlogController::class, 'index']);
Route::post('/blogd', [BlogController::class, 'desc']);
Route::get('/gupdate', [IgController::class, 'gupdate']);
Route::post('/mailChimp', [IgController::class, 'mailChimp']);


// Route::post('/login', [AuthController::class, 'login']);

// Route::post('/product1', [ProductController::class, 'addProduct']); 
// Route::post('/product2', [ProductController::class, 'addProduct2']); 
// Route::get('/', function () {
//     return view('welcome');
// });
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
