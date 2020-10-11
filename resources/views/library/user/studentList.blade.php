@extends('layouts.app')

@section('content')
    <div class="container" id="studentListPage">
        <div class="card-body" style="height:70vh; overflow:auto;">
            <section class="table-responsive tableFixHead">
                <table class="table table-bordered insert_books">
                    <thead>
                        <tr>
                            <th class="text-center" scope="col">ID</th>
                            <th class="text-center" scope="col">Name</th>
                            <th class="text-center" scope="col">Gender</th>
                            <th class="text-center" scope="col">Course</th>
                            <th class="text-center" scope="col">Birthdate</th>
                            <th class="text-center" scope="col">Email</th>
                            <th class="text-center" scope="col">Phone</th>
                            <th class="text-center" scope="col">Address</th>
                            <th class="text-center" scope="col">Borrowed book(s)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td class="text-center">{{ $user->id }}</td>
                                <td class="text-center">{{ $user->name }}</td>
                                <td class="text-center">{{ $user->gender }}</td>
                                <td class="text-center">{{ $user->course_year }}</td>
                                <td class="text-center">{{ $user->date_of_birth }}</td>
                                <td class="text-center">{{ $user->email }}</td>
                                <td class="text-center">{{ $user->phone }}</td>
                                <td class="text-center">{{ $user->address }}</td>
                                <td class="text-center">
                                    <!-- Button trigger modal -->
                                    <button type="button" id="{{ $user->id }}" class="btn btn-primary book_list_modal"
                                        data-toggle="modal" style="width: 80px" data-target="#book_list">
                                        Book(s)
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                </table>
                <!-- Modal -->
                <div class="modal fade" id="book_list" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">

                        <div class="modal-content">
                            <div class="modal-header text-center">
                                <h3 class="modal-title w-100"><strong>Borrowed Book(s)</strong></h3>
                            </div>
                            <div class="modal-body">
                                <div class="table-responsive tableFixHead">
                                    <table class="table table-bordered book_list">
                                        <thead>
                                            <tr>
                                                <th class="text-center" scope="col">ID</th>
                                                <th class="text-center" scope="col">Title</th>
                                                <th class="text-center" scope="col">Author</th>
                                                <th class="text-center" scope="col">Price</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div id="links">
                {{ $users->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <script type="application/javascript" defer>
        if ($('#studentListPage').length) {
            $('.book_list_modal').on('click', function() {
                $.ajax({
                    url: '/library/book/getBorrowedBooks',
                    data: {
                        'id': this.id
                    },
                    type: 'GET',
                    success: function(books) {
                        $('.book_list > tbody').empty();
                        if (books.length) {
                            for (let i = 0; i < books.length; i++) {
                                $('.book_list > tbody:last-child').append(function() {
                                    $('<tr/>', {
                                        appendTo: this,
                                        function() {
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: books[i].id,
                                                appendTo: this
                                            });
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: books[i].title,
                                                appendTo: this
                                            });
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: books[i].author,
                                                appendTo: this
                                            });
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: books[i].price,
                                                appendTo: this
                                            });
                                        }
                                    });

                                });
                            }
                        } else {
                            $('.book_list:last-child').append(function() {
                                $('.book_list > tbody:last-child').append(function() {
                                    $('<tr/>', {
                                        appendTo: this,
                                        function() {
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: 'N/A',
                                                appendTo: this
                                            });
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: 'N/A',
                                                appendTo: this
                                            });
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: 'N/A',
                                                appendTo: this
                                            });
                                            $('<td/>', {
                                                class: 'text-center',
                                                text: 'N/A',
                                                appendTo: this
                                            });
                                        }
                                    });

                                });

                            })
                        }

                    }
                });
            })
        }

    </script>
@endsection
