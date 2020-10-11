<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { 
            $table->id('id')->unique();
            $table->string('name');
            $table->string('password');
            $table->json('add_to_cart')->nullable();
            $table->json('borrowed_books_id')->nullable();
            $table->json('returned_books_id')->nullable();
            $table->json('confirm_borrowed_books_id')->nullable();
            $table->string('email')->unique();
            $table->string('gender');
            $table->string('course_year');
            $table->string('date_of_birth');
            $table->string('phone');
            $table->string('address');
            $table->boolean('is_admin')->default(0);
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
