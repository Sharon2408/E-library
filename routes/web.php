<?php

use App\Http\Controllers\BookShelfController;
use App\Http\Controllers\PlanController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Request;

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



// Category Controller

Route::get('/', [CategoryController::class, 'index'])->name('home');

//Books Controller

Route::get('/library/book/{category_id}', [BooksController::class, 'index'])->name('library.book');//->middleware('verified');
Route::post('/library/book', [BooksController::class, 'store'])->name('book.store');
Route::get('/admin/createbook', [BooksController::class, 'createBook'])->name('admin.createbook'); //->middleware('can:view,book');
Route::get('/admin/book', [BooksController::class, 'getBooks'])->name('admin.book');//->middleware('can:view,App\Models\Book::class');
Route::get('/admin/editbook/{book}', [BooksController::class, 'show']); //->middleware('can:view,book');
Route::patch('/admin/{book}', [BooksController::class, 'update']);
Route::delete('/admin/{employee}', [BooksController::class, 'softDelete']);
Route::get('/library/{book}/singlebookview', [BooksController::class, 'singleBookView']);

// BookShelf Controller

Route::post('/library/{book}', [BookShelfController::class, 'bookShelf']);
Route::get('/library/bookshelf', [BookShelfController::class, 'viewBookShelf'])->middleware('auth')->middleware('verified');
Route::delete('/bookshelf/{bookshelfid}', [BookShelfController::class, 'destroy']);

Route::get('/admin/showdeleted',[BooksController::class,'showDeletedBooks'])->name('showdeleted');
Route::get('/admin/restoredeleted',[BooksController::class,'restore'])->name('restoredeleted');

// Search Functionality
Route::any('/search', function () {
    $q = Request::get('q');
    $searchcategory = Category::where('category_name', 'LIKE', '%' . $q . '%')->get();
    if (count($searchcategory) > 0) {
        return view('home')->withDetails($searchcategory)->withQuery($q);
    } else {
        return view('home')->withMessage('No Matches found')->withQuery($q);
    }
})->name('search');

// Authentication
Auth::routes([
    'verify' => true
]);

// Plan Controller
Route::get('/library/subscribe', [PlanController::class, 'index'])->name('subscribe');
Route::post('/Plan/{plan}', [PlanController::class, 'payment']);
Route::get('/admin/viewplans', [PlanController::class, 'showPlans']);
Route::get('/admin/createplan', [PlanController::class, 'createPlan']);
Route::post('/admin/viewplans', [PlanController::class, 'storePlan'])->name('plan.store');
Route::get('/admin/{plan}/editplan', [PlanController::class, 'show']);
Route::patch('/plan/{plan}', [PlanController::class, 'updatePlan']);
Route::delete('/plan/{plan}', [PlanController::class, 'destroy']);
Route::post('/payment/receipt/{planid}', [PlanController::class, 'store']);

// Custom error page
Route::get('library/error', function () {
    return view('/library/error');
});