<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller {
    /**
    * Create a new controller instance.
    *
    * @return void
    */

    public function __construct() {
        $this->middleware( ['auth'] );
    }

    /**
    * Show the application dashboard.
    *
    * @return \Illuminate\Contracts\Support\Renderable
    */

    public function index() {   
        $users = User::where(function($query){
            return $query->where('is_admin', 0)
            ->where('borrowed_books_id', '!=', null)
            ->orWHere('returned_books_id', '!=', null);
        })->get();
 
        $borrowed_books_id = [];
        $returned_books_id = [];
        $total = 0;

        foreach ( $users as $user ) {
            if ( $user->borrowed_books_id != null ) {
                $borrowed = array(
                    'user' => $user
                );
                $borrowed['books'] = Book::whereIn( 'id', $user->borrowed_books_id )->get();
                $borrowed_books_id[] = $borrowed;
            }
            if ( $user->returned_books_id != null ) {
                $returned = array(
                    'user' => $user
                );
                $returned['books'] = Book::whereIn( 'id', $user->returned_books_id )->get();

                $returned_books_id[] = $returned;
            }
        }

        return view( 'home', ['users' => $users, 'total' => $total, 'borrowed_books_id' => $borrowed_books_id, 'returned_books_id' => $returned_books_id] );
    }
}
