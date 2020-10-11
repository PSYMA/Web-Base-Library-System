@extends('layouts.app')

@section('content')
    {{-- <div class="container">
        <div class="jumbotron d-flex align-items-center bg-light"></div>
        <div class="row  justify-content-center">
            <div class="col-md-6">
                <div class="container row  justify-content-center">
                    <h1><strong>Delete Book</strong></h1>
                </div>
                <div class="container row  justify-content-center">
                    <p>Are you sure you want to delete this
                        book? ID: {{ $book->id }}
                    </p>
                </div>
                <div class="container">
                    <form action="{{ route('library.book.destroy', $book->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <div class="container btn-group btn-block" role="group" aria-label="Basic example">
                            <a href="javascript:history.go(-1)" type="button" class="btn btn-secondary mr-1">Cancel</a>
                            <button type="submit" type="button" class="btn btn-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
@endsection
