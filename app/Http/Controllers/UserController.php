<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller {

    public function __construct() {
        $this->middleware( ['auth'] );
    }

    public function update( $id ) {
        // update user borrowed books
        $user = User::findOrFail( $id );
        if ( $user->borrowed_books_id != null ) {
            $arr1 = array_unique( request( 'selected_books_id' ) );
            $arr2 = $user->borrowed_books_id;
            $results = array_merge ( $arr1, $arr2 ) ;
            sort( $results );
            $user->borrowed_books_id  =  $results ;
        } else {
            $user->borrowed_books_id = array_unique( request( 'selected_books_id' ) );
        }
        $user->add_to_cart = null;
        $user->save();

        // update books stacks
        foreach ( request( 'selected_books_id' ) as $book_id ) {
            $book = Book::findOrFail( $book_id );
            $book->stacks -= 1;
            $book->save();
        }

        return redirect( '/' )->with( 'mssg', 'Book(s) borrowed waiting for confirmation' );
    }

    public function confirmToBorrow( $id ) {
        $user = User::findOrFail( $id );
        if ( $user->confirm_borrowed_books_id != null ) {
            $arr1 = $user->confirm_borrowed_books_id;
            $arr2 =  $user->borrowed_books_id;
            $results = array_merge ( $arr1, $arr2 ) ;
            sort( $results );
            $user->confirm_borrowed_books_id = $results;
        } else {
            $user->confirm_borrowed_books_id = ( $user->borrowed_books_id );
        }
        $user->borrowed_books_id = null;
        $user->save();

        return redirect()->back()->with( 'mssg_borrowed', 'Borrow book(s) confirmed!' );
    }

    public function confirmToReturn( $id ) {
        $user = User::findOrFail( $id );
        foreach ( $user->returned_books_id as $book_id ) {
            $book = Book::findOrFail( $book_id );
            $book->stacks += 1;
            $book->save();
        }
        $user->returned_books_id = null;
        $user->save();

        return redirect()->back()->with( 'mssg_returned', 'Return book(s) confirmed!' );
    }

    public function returnSingleBook( $book_id ) {
        $user = User::findOrFail( request()->user()->id );
        $array =  $user->confirm_borrowed_books_id;
        array_splice( $array, array_search( $book_id, $array ), 1 );
        $user->confirm_borrowed_books_id = $array;

        if ( $user->returned_books_id != null ) {
            $arr1 = $user->returned_books_id;
            $arr2 = [$book_id];
            $results = array_merge ( $arr1, $arr2 ) ;
            sort( $results );
            $user->returned_books_id = $results;
        } else {
            $user->returned_books_id = [$book_id];
        }
        $user->save();

        return redirect()->back()->with( 'mssg', 'Book(s) returned waiting for confirmation' );
    }

    public function returnAllBook() {
        $user = User::findOrFail( request()->user()->id );
        if ( $user->returned_books_id != null ) {
            $arr1 = $user->returned_books_id;
            $arr2 = $user->confirm_borrowed_books_id;
            $results = array_merge ( $arr1, $arr2 ) ;
            sort( $results );
            $user->returned_books_id = $results;
        } else {
            $user->returned_books_id = $user->confirm_borrowed_books_id;
        }

        $user->confirm_borrowed_books_id = null;
        $user->save();
        return redirect()->back()->with( 'mssg', 'Book(s) returned waiting for confirmation' );
    }

    public function returnBook() {
        $user = request()->user();
        $books = [];
        if ( $user->confirm_borrowed_books_id != null ) $books = Book::whereIn( 'id', $user->confirm_borrowed_books_id )->paginate( 10 );
        return view( 'library/user/returnBook', ['user' => $user, 'books' => $books] );
    }

    public function viewRecords() {
        $user = request()->user();
        $books = [];
        if ( $user->confirm_borrowed_books_id != null ) $books = Book::whereIn( 'id', $user->confirm_borrowed_books_id )->paginate( 10 );
        return view( 'library/user/viewRecords', ['user' => $user, 'books' => $books] );
    }

    public function studentList() {
        return view( 'library/user/studentList', ['users' => User::where( 'is_admin', 0 )->paginate( 5 )] );
    }

    public function getBorrowedBooks() {
        $id = request()->id;
        $user = User::findOrFail( $id );
        $books = [];
        if ( $user->confirm_borrowed_books_id != null ){
            $books = Book::whereIn( 'id', $user->confirm_borrowed_books_id )->get();
        }

        return $books;
    }
}
