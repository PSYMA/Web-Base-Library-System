@extends('layouts.app')

@section('content')
    <div class="container" id="bookListPage">
        <input class="btn btn-default border-dark text-center float-right" type="text" id="search" name="search"
            placeholder="Search book">
        <div class=" row justify-content-center" role="alert">
            @if (session()->has('mssg'))
                <div class="alert alert-success row justify-content-center">{{ session('mssg') }}</div>
            @endif
        </div>
        <div class="table-responsive tableFixHead">
            <table class="table table-bordered book_list">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Author</th>
                        <th class="text-center" scope="col">Price</th>
                        <th class="text-center" scope="col">Stacks</th>
                        <th class="text-center" scope="col">Status</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td class="text-center" scope="row">{{ $book->id }}</td>
                            <td class="text-center"> {{ $book->title }}</td>
                            <td class="text-center"> {{ $book->author }}</td>
                            <td class="text-center"> {{ $book->price }}</td>
                            <td class="text-center"> {{ $book->stacks }}</td>
                            @if ($book->stacks === 0)
                                <td class="text-center">N/A</td>
                            @else
                                <td class="text-center">AVAILABLE</td>
                            @endif
                            <td class="text-center">
                                <div class="btn-group">
                                    <a href="{{ route('library.book.editBook', $book->id) }}" class="btn btn-secondary mr-1"
                                        style="width: 80px">EDIT</a>
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" style="width: 80px"
                                        data-target="#delete_book_modal{{ $book->id }}">
                                        DELETE
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="delete_book_modal{{ $book->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-body">
                                                    <div class="container row  justify-content-center">
                                                        <h1><strong>Delete Book</strong></h1>
                                                    </div>
                                                    <div class="container row  justify-content-center">
                                                        <p>Are you sure you want to delete this
                                                            book? ID: {{ $book->id }}
                                                        </p>
                                                    </div>
                                                    <div class="container">
                                                        <form action="{{ route('library.book.destroy', $book->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <div class="container btn-group btn-block" role="group"
                                                                aria-label="Basic example">
                                                                <button type="button" class="btn btn-secondary mr-1"
                                                                    data-dismiss="modal">Close</button>
                                                                <button type="submit" type="button"
                                                                    class="btn btn-danger">Delete</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="links">
            {{ $books->links('pagination::bootstrap-4') }}
        </div>
    </div>
    <script type="application/javascript" defer>
        if ($('#bookListPage').length) {
            let displayed_books = @json($books);
            function displayBooks(books) {
                for (let i = 0; i < books.length; i++) {
                    $('.book_list > tbody:last-child').append('<tr></tr>');
                    $('.book_list > tbody > tr:last-child').append(
                        '<td class="text-center">' + books[i].id +
                        '</td>');
                    $('.book_list > tbody > tr:last-child').append('<td class="text-center">' + books[i]
                        .title + '</td>');
                    $('.book_list > tbody > tr:last-child').append('<td class="text-center">' + books[i]
                        .author + '</td>');
                    $('.book_list > tbody > tr:last-child').append('<td class="text-center">' + books[i]
                        .price + '</td>');
                    $('.book_list > tbody > tr:last-child').append('<td class="text-center">' + books[i]
                        .stacks + '</td>');
                    if (books[i].stacks == 0) {
                        $('.book_list > tbody > tr:last-child').append(
                            '<td class="text-center">N/A</td>');
                    } else {
                        $('.book_list > tbody > tr:last-child').append(
                            '<td class="text-center">AVAILABLE</td>');
                    }
                    $('.book_list > tbody > tr:last-child').append(function() {
                        $('<td/>', {
                            class: 'text-center',
                            appendTo: this,
                            function() {
                                $('<div/>', {
                                    class: 'btn-group',
                                    appendTo: this,
                                    function() {
                                        $('<a/>', {
                                            class: 'btn btn-secondary mr-1',
                                            style: "width: 80px",
                                            text: 'EDIT',
                                            href: '/library/book/editBook/' +
                                                books[i].id,
                                            appendTo: this
                                        });
                                        $('<a/>', {
                                            class: 'btn btn-danger',
                                            style: "width: 80px",
                                            text: 'DELETE',
                                            href: '/library/book/deleteBook/' +
                                                books[i].id,
                                            appendTo: this
                                        })
                                    }
                                })
                            }
                        });
                    })
                }
            }
         
            $("input#search").bind('keyup', function() {
                if ($(this).val() === '') {
                    $('.book_list tbody').empty();
                    $('#links').show();
                    displayBooks(displayed_books.data);

                } else {
                    const searchResult = $(this).val();
                    $.ajax({
                        url: '/library/book/searchBook',
                        data: {
                            'search_result': searchResult
                        },
                        type: 'GET',
                        success: function(books) {
                            if (books.length) {
                                $('#links').hide();
                                $('.book_list tbody').empty();
                                displayBooks(books);
                            }

                        }
                    });
                }
            });
        }

    </script>
@endsection
