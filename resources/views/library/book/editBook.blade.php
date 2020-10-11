@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><strong class="row justify-content-center">EDIT BOOK SECTION</strong>
                </div>
                <div class="card-body">
                    <form method="POST" id="edit_form" action="{{ route('library.book.update', $book->id) }}">
                        @csrf
                        @method('PATCH')
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="id" class="col">{{ __('ID') }}</label>
                                <div class="col-md-12">

                                    <input id="id" type="number" class="form-control @error('id') is-invalid @enderror"
                                        name="id" value="{{ $book->id }}" required autocomplete="id">

                                    @error('id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="title" class="col">{{ __('Title') }}</label>
                                <div class="col-md-12">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror"
                                        name="title" value="{{ $book->title }}" required autocomplete="title">

                                    @error('title')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="author" class="col">{{ __('Author') }}</label>
                                <div class="col-md-12">
                                    <input id="author" type="text"
                                        class="form-control @error('author') is-invalid @enderror" name="author"
                                        value="{{ $book->author }}" required autocomplete="author">
                                    @error('author')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-3">
                            <div class="col">
                                <label for="price" class="col">{{ __('Price') }}</label>
                                <div class="col-md-12">
                                    <input id="price" type="number"
                                        class="form-control @error('price') is-invalid @enderror" name="price"
                                        value="{{ $book->price }}" required autocomplete="price" min="0" step="0.01"
                                        pattern="^\d+(?:\.\d{1,2})?$">

                                    @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-row mb-4">
                            <div class="col">
                                <label for="stacks" class="col">{{ __('Stacks') }}</label>
                                <div class="col-md-12">
                                    <input id="stacks" type="number"
                                        class="form-control @error('stacks') is-invalid @enderror" name="stacks"
                                        value="{{ $book->stacks }}" required autocomplete="stacks">

                                    @error('stacks')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="container btn-group btn-block" role="group" aria-label="Basic example">
                            <a href="javascript:history.go(-1)" type="button" class="btn btn-secondary mr-1">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
