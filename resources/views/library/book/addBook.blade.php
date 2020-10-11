@extends('layouts.app')

@section('content')
    <div class="container w-50 p-3">
        <div class="row align-items-center">
            <div class="col-12 mx-auto">
                <div class="jumbotron">
                    <div class="container">
                        <h1 class="d-flex justify-content-center h1"><strong>Add Book</strong></h1>
                    </div><br>
                    <form method="POST" action="{{ route('library.book.store') }}">
                        @csrf
                        <div class="form-group">
                            <input id="id" type="number" class="form-control @error('id') is-invalid @enderror" name="id"
                                value="{{ old('id') }}" placeholder="ID" required autocomplete="id">

                            @error('id')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                name="title" value="{{ old('title') }}" placeholder="Title" required autocomplete="title">

                            @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="author" type="text" class="form-control @error('author') is-invalid @enderror"
                                name="author" placeholder="Author" value="{{ old('author') }}" required
                                autocomplete="author">

                            @error('author')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror"
                                name="price" onKeyPress="if(this.value.length==9) return false;" value="{{ old('price') }}"
                                required autocomplete="price" placeholder="Price" min="0" step="0.01"
                                pattern="^\d+(?:\.\d{1,2})?$">

                            @error('price')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input id="stacks" type="number" class="form-control @error('stacks') is-invalid @enderror"
                                name="stacks" value="{{ old('stacks') }}" placeholder="Stacks" required
                                autocomplete="stacks">

                            @error('stacks')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <button type="submit" class="btn btn-success btn-lg btn-block">Add Book</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
