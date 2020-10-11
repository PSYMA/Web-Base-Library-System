@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @if (session()->has('mssg'))
                <div class="alert alert-success row justify-content-center">{{ session('mssg') }}
                </div>
            @endif
        </div>
        <section class="table-responsive tableFixHead">
            <table class="table table-bordered insert_books">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Author</th>
                        <th class="text-center" scope="col">Price</th>
                        <th class="text-center" scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @if (!empty($user->confirm_borrowed_books_id))
                        @foreach ($books as $book)
                            @if ($user->confirm_borrowed_books_id)
                                @if (in_array($book->id, $user->confirm_borrowed_books_id))
                                    <tr>
                                        <td class="text-center">{{ $book->id }}</td>
                                        <td class="text-center">{{ $book->title }}</td>
                                        <td class="text-center">{{ $book->author }}</td>
                                        <td class="text-center">{{ $book->price }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('library.user.returnSingleBook', $book->id) }}"
                                                method="POST">
                                                @csrf
                                                @method('PATCH')
                                                <input type="submit" value="Return" class="btn btn-danger">
                                            </form>
                                        </td>
                                    </tr>
                                @endif
                            @endif
                        @endforeach


                    @endif --}}
                    @foreach ($books as $book)
                        <tr>
                            <td class="text-center">{{ $book->id }}</td>
                            <td class="text-center">{{ $book->title }}</td>
                            <td class="text-center">{{ $book->author }}</td>
                            <td class="text-center">{{ $book->price }}</td>
                            <td class="text-center">
                                <form action="{{ route('library.user.returnSingleBook', $book->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="submit" value="Return" class="btn btn-danger">
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    @if (count($books))
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td class="text-center">
                                <form action="{{ route('library.user.returnAllBook') }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="submit" value="Return All" class="btn btn-success">
                                </form>
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
         
        </section>
        <div id="links">
            @if (count($books))
                {{ $books->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection
