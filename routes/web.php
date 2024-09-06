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
Route::controller(CategoryController::class)->group(function () {
    Route::get('/', 'index')->name('home');
});

//Books Controller
Route::controller(BooksController::class)->group(function () {

    Route::get('/library/book/{category_id}', 'index')->name('library.book')->middleware('verified');
    Route::post('/library/book', 'store')->name('book.store');
    Route::get('/admin/createbook', 'createBook')->name('admin.createbook'); //->middleware('can:view,book');
    Route::get('/admin/book', 'getBooks')->name('admin.book'); //->middleware('can:view,App\Models\Book::class');
    Route::get('/admin/editbook/{book}', 'show'); //->middleware('can:view,book');
    Route::patch('/admin/{book}', 'update');
    Route::delete('/admin/{employee}', 'softDelete');
    Route::get('/library/{book}/singlebookview', 'singleBookView');
    Route::get('/admin/restoredeleted', 'restore')->name('restoredeleted');

});


// BookShelf Controller
Route::controller(BookShelfController::class)->group(function () {

    Route::post('/library/{book}', 'bookShelf');
    Route::get('/library/bookshelf', 'viewBookShelf')->middleware('auth')->middleware('verified');
    Route::delete('/bookshelf/{bookshelfid}', 'destroy');
    Route::get('/admin/showdeleted', 'showDeletedBooks')->name('showdeleted');
    

});


// Plan Controller
Route::controller(PlanController::class)->group(function () {

    Route::get('/library/subscribe', 'index')->name('subscribe');
    Route::post('/Plan/{plan}', 'payment');
    Route::get('/admin/viewplans', 'showPlans');
    Route::get('/admin/createplan', 'createPlan');
    Route::post('/admin/viewplans', 'storePlan')->name('plan.store');
    Route::get('/admin/{plan}/editplan', 'show');
    Route::patch('/plan/{plan}', 'updatePlan');
    Route::delete('/plan/{plan}', 'destroy');
    Route::post('/payment/receipt/{planid}', 'store');
    Route::get('/payment/receipt', 'receipt');
    Route::get('/download-receipt', 'downloadReceipt')->name('download.receipt');
});


// Authentication
Auth::routes([
    'verify' => true
]);

// Custom error page
Route::get('library/error', function () {
    return view('/library/error');
});


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