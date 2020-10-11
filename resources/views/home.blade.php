@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col border-right">
                <h2 class="d-flex justify-content-center"><strong>Returned Book(s)</strong></h2>
                <hr>
                <div class="row justify-content-center">
                    @if (session()->has('mssg_returned'))
                        <div class="alert alert-success row justify-content-center">
                            {{ session('mssg_returned') }}
                        </div>
                    @endif
                </div>
                @if (count($returned_books_id))
                    @for ($i = 0; $i < count($returned_books_id); $i++)
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <strong>ID: {{ $returned_books_id[$i]['user']->id }}
                                        </strong>
                                        <br><strong>Name: {{ $returned_books_id[$i]['user']->name }}</strong>
                                    </div>
                                    <div class="table-responsive tableFixHead">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">ID</th>
                                                    <th class="text-center" scope="col">Title</th>
                                                    <th class="text-center" scope="col">Price</th>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($returned_books_id[$i]['books'] as $book)
                                                    <tr>
                                                        <td class="text-center" scope="row">
                                                            {{ $book->id }}</td>
                                                        <td class="text-center">
                                                            {{ $book->title }}</td>
                                                        <td class="text-center">
                                                            {{ $book->price }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <form
                                                            action="{{ route('library.user.confirmToReturn', $returned_books_id[$i]['user']->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="submit" class="btn btn-danger" value="Confirm">
                                                            </input>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    @endfor
                @else
                    <p class="d-flex justify-content-center"><strong>No book(s) has been return</strong></p>
                @endif
            </div>
           
            <div class="col">
                <h2 class="d-flex justify-content-center"><strong>Borrowed Book(s)</strong></h2>
                <hr>
                <div class="row justify-content-center">
                    @if (session()->has('mssg_borrowed'))
                        <div class="alert alert-success row justify-content-center">
                            {{ session('mssg_borrowed') }}
                        </div>
                    @endif
                </div>
                @if (count($borrowed_books_id))
                    @for ($i = 0; $i < count($borrowed_books_id); $i++)
                        <div class="row justify-content-center" >
                            <div class="col-md-12" >
                                <div class="card">
                                    <div class="card-header">
                                        <strong>ID: {{ $borrowed_books_id[$i]['user']->id }}
                                        </strong>
                                        <br><strong>Name: {{ $borrowed_books_id[$i]['user']->name }}</strong>
                                    </div>
                                    <div class="table-responsive tableFixHead">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" scope="col">ID</th>
                                                    <th class="text-center" scope="col">Title</th>
                                                    <th class="text-center" scope="col">Price</th>
                                                    <th class="text-center" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($borrowed_books_id[$i]['books'] as $book)
                                                    <p hidden>{{ $total += $book->price }}</p>
                                                    <tr>
                                                        <td class="text-center" scope="row">
                                                            {{ $book->id }}</td>
                                                        <td class="text-center">
                                                            {{ $book->title }}</td>

                                                        <td class="text-center">
                                                            {{ $book->price }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td></td>
                                                    <td class="text-center"><strong>Total:</strong>
                                                    </td>
                                                    <td class="text-center">
                                                        <u><strong>{{ $total }}</strong></u></td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="text-center">
                                                        <form
                                                            action="{{ route('library.user.confirmToBorrow', $borrowed_books_id[$i]['user']->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <input type="submit" class="btn btn-danger" value="Confirm">
                                                            </input>
                                                        </form>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                    @endfor
                @else
                    <p class="d-flex justify-content-center"><strong> No book(s) has been borrow</strong></p>
                @endif
            </div>
        </div>
    </div>
@endsection
