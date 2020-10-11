@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="table-responsive tableFixHead">
            <table class="table table-bordered insert_books">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">ID</th>
                        <th class="text-center" scope="col">Title</th>
                        <th class="text-center" scope="col">Author</th>
                        <th class="text-center" scope="col">Price</th>
                        <th class="text-center" scope="col">Quantitie(s)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td class="text-center">{{ $book->id }}</td>
                            <td class="text-center">{{ $book->title }}</td>
                            <td class="text-center">{{ $book->author }}</td>
                            <td class="text-center">{{ $book->price }}</td>
                            <td class="text-center">1</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
         
        </div>
        <div id="links">
            @if (count($books))
                {{ $books->links('pagination::bootstrap-4') }}
            @endif
        </div>
    </div>
@endsection
