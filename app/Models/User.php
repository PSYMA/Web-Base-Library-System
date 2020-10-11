<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'id', 'name', 'add_to_cart', 'borrowed_books_id', 'returned_books_id', 'course_year', 'email', 'gender', 'date_of_birth', 'phone', 'address', 'password',
    ];

    /**
    * The attributes that should be hidden for arrays.
    *
    * @var array
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'add_to_cart' => 'array',
        'borrowed_books_id' => 'array',
        'returned_books_id' => 'array',
        'confirm_borrowed_books_id' => 'array',
    ];
 
}
