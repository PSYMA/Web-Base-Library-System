<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller {
    public function __construct() {
        $this->middleware( ['auth'] );
    }

    public function update( $id ) {
        request()->validate( [
            'id' => 'min:6|max:6|unique:books,id,' . $id,
        ] );

        $book = Book::findOrFail( $id );

        $book->id = request( 'id' );
        $book->title = request( 'title' );
        $book->author = request( 'author' );
        $book->price = request( 'price' );
        $book->stacks = request( 'stacks' );
        $book->save();

        return redirect( 'library/book/bookList' )->with( 'mssg', 'Updated successfully!' );
    }

    public function destroy( $id ) {
        $book = Book::findOrFail( $id );
        $book->delete();

        return redirect( 'library/book/bookList' )->with( 'mssg', 'Deleted successfully!' );
    }

    public function store( Request $request ) {
        $validated_data = $request->validate( [
            'id' => 'required|unique:books|min:6|max:6',
        ] );

        $book = new Book;
        $book->id = request( 'id' );
        $book->title = request( 'title' );
        $book->author = request( 'author' );
        $book->price = request( 'price' );
        $book->stacks = request( 'stacks' );
        $book->save();

        return redirect( '/' )->with( 'mssg', 'Thanks! book has been added' );
    }

    public function bookList() {
        return view( 'library/book/bookList', ['books' => Book::orderBy( 'id' )->paginate( 10 )] );
    }

    public function addBook() {
        return view( 'library/book/addBook' );
    }

    public function borrowBook() {
 
        $user = request()->user();
        $books = [];
        $arr1 = $user->borrowed_books_id;
        $arr2 = $user->returned_books_id;
        $arr3 = $user->confirm_borrowed_books_id;
        $array = array_merge( ( array ) $arr1, ( array ) $arr2, ( array ) $arr3 );

        if ( !empty( $array ) ) {
            $books = Book::whereNotIn( 'id', $array )->paginate( 10 );
        } else {
            $books = Book::paginate( 10 );
        }
        return view( 'library/book/borrowBook', ['books' => $books, 'user' => $user] );
    }

    public function editBook( $book_id ) {
        $book = Book::findOrFail( $book_id );

        return view( 'library/book/editBook', ['book' => $book] );
    }

    public function deleteBook( $book_id ) {
        $book = Book::findOrFail( $book_id );
        return view( 'library/book/deleteBook', ['book' => $book] );
    }

    public function searchBook() {
        $search_result = request()->search_result;
        $search_book = Book::where( 'id', 'LIKE', '%' . $search_result . '%' )
        ->orWHere( 'title', 'LIKE', '%' . $search_result . '%' )
        ->orWHere( 'author', 'LIKE', '%' . $search_result . '%' )->get();

        return $search_book;
    }

    public function addToCart() {
        $user = request()->user();
        if ( $user->add_to_cart != null ) {
            $arr1 = $user->add_to_cart;
            $arr2 = request()->selected_books_id;
            $arr3 = Book::whereIn( 'id', $arr1 )->where( 'stacks', '!=', 0 )->pluck( 'id' )->toArray();
            $results = array_unique( array_merge( ( array ) $arr3, ( array ) $arr2 ) );
            sort( $results );

            $user->add_to_cart = $results;
        } else {
            $user->add_to_cart = request()->selected_books_id;
        }
        $user->save();

        return $user->add_to_cart;
    }

    public function removeToCart() {
        $user = request()->user();
        $delete = request()->book;
        $books = $user->add_to_cart;

        unset( $books[array_search( $delete, $books )] );

        $user->add_to_cart = $books;
        $user->save();

        return $user->add_to_cart;
    }

    public function getSelectedBook() {
        $selected_books_id = request()->selected_books_id;
        $book = [];
        if ( $selected_books_id ) {
            $book = Book::whereIn( 'id', $selected_books_id )->get();
        }

        return $book;
    }
}
