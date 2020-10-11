<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\UserMiddleware;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'throttle:100,1'], function () {
    Route::get('/', function () {
        return view('welcome');
    });

    Auth::routes();

    // Book Route
    Route::group(['prefix' => '/library/book'], function () {
        Route::group(['middleware' => UserMiddleware::class], function () {
            Route::get('/borrowBook', [BookController::class, 'borrowBook'])->name('library.book.borrowBook');
        });
        Route::group(['middleware' => AdminMiddleware::class], function () {
            Route::post('/store', [BookController::class, 'store'])->name('library.book.store');
            Route::patch('/update/{id}', [BookController::class, 'update'])->name('library.book.update');
            Route::delete('/destroy/{id}', [BookController::class, 'destroy'])->name('library.book.destroy');
            Route::get('/addBook', [BookController::class, 'addBook'])->name('library.book.addBook');
            Route::get('/bookList', [BookController::class, 'bookList'])->name('library.book.bookList');
            Route::get('/editBook/{id}', [BookController::class, 'editBook'])->name('library.book.editBook');
            Route::get('/deleteBook/{id}', [BookController::class, 'deleteBook'])->name('library.book.deleteBook');
            Route::get('/getBorrowedBooks', [UserController::class, 'getBorrowedBooks'])->name('library.book.getBorrowedBooks');
        });
    });

    Route::get('/library/book/searchBook', [BookController::class, 'searchBook'])->name('library.book.searchBook');
    Route::get('/addToCart', [BookController::class, 'addToCart'])->name('library.book.addToCart');
    Route::get('/removeToCart', [BookController::class, 'removeToCart'])->name('library.book.removeToCart');
    Route::get('/getSelectedBook', [BookController::class, 'getSelectedBook'])->name('library.book.getSelectedBook');

    // User Route
    Route::group(['prefix' => '/library/user'], function () {
        Route::group(['middleware' => UserMiddleware::class], function () {
            Route::get('/returnBook', [UserController::class, 'returnBook'])->name('library.user.returnBook');
            Route::get('/viewRecords', [UserController::class, 'viewRecords'])->name('library.user.viewRecords');
            Route::patch('/update/{id}', [UserController::class, 'update'])->name('library.user.update');
            Route::patch('/returnSingleBook/{id}', [UserController::class, 'returnSingleBook'])->name('library.user.returnSingleBook');
            Route::patch('/returnAllBook', [UserController::class, 'returnAllBook'])->name('library.user.returnAllBook');
        });
        Route::group(['middleware' => AdminMiddleware::class], function () {
            Route::patch('/confirmToBorrow/{id}', [UserController::class, 'confirmToBorrow'])->name('library.user.confirmToBorrow');
            Route::patch('/confirmToReturn/{id}', [UserController::class, 'confirmToReturn'])->name('library.user.confirmToReturn');
            Route::get('/studentList', [UserController::class, 'studentList'])->name('library.user.studentList');
        });
    });

    // Home Route
    Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(AdminMiddleware::class);
});
