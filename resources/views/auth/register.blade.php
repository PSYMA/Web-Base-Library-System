@extends('layouts.app')

@section('content')
    <div class="container bg-light">
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <h1 class="d-flex justify-content-center"><strong>Register</strong></h1>
            <p class="d-flex justify-content-center text-secondary">Create your account. It's free and only takes a
                minute.</p>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input id="id" type="number" class="form-control @error('id') is-invalid @enderror" name="id"
                            value="{{ old('id') }}" placeholder="ID" required autocomplete="id">

                        @error('id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                            value="{{ old('name') }}" placeholder="Full Name" required autocomplete="name" autofocus>

                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <div class="col">
                        <input id="gender" type="hidden" class="form-control @error('gender') is-invalid @enderror"
                            name="gender" value="Male" required autocomplete="gender">
                        <select class="form-control text-secondary" onchange="myFunction(this.value);">
                            <option>Male</option>
                            <option>Female</option>
                        </select>
                        <script type="application/javascript">
                            function myFunction(element) {
                                document.getElementById("gender").value = element;
                            }

                        </script>
                    </div>
                    <div class="col">
                        <input id="date_of_birth" type="text"
                            class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth"
                            placeholder="Date of Birth" onfocus="(this.type='date')" value="{{ old('date_of_birth') }}"
                            required autocomplete="date_of_birth">

                        @error('date_of_birth')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    value="{{ old('email') }}" placeholder="Email" required autocomplete="email">

                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="course_year" type="text" class="form-control @error('course_year') is-invalid @enderror"
                    name="course_year" placeholder="Course Year" value="{{ old('course_year') }}" required
                    autocomplete="course_year">

                @error('course_year')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone"
                    value="{{ old('phone') }}" placeholder="Phone Number" required autocomplete="phone">

                @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>


            <div class="form-group">
                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address"
                    value="{{ old('address') }}" placeholder="Address" required autocomplete="address">

                @error('address')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                    name="password" placeholder="Password" required autocomplete="new-password">

                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                    placeholder="Confirm Password" required autocomplete="new-password">
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Register Now</button>
            </div>
        </form>
    </div>
@endsection
