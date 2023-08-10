@extends('layouts.index')
@section('content')

<body class="body">
    <div class="testimonial-item bg-light rounded p-4">
        <div class="imageSection-register">
            <div class="textInside-register">
                <h1>Register for your better future</h1>
                <p class="tagLine-register">NOW</p>
            </div>
            <div class="service-register">
                <p><span class="price-register"></span></p>
            </div>
        </div>
        <div class="contactForm-register">
            <h1>Registration Form</h1>
            <form action="{{ route('register-user') }}" method="POST">
                @method('POST')
                @if(Session::has('success'))
                <div class="alert alert-success">{{Session::get('success')}}</div>
                @endif
                @if(Session::has('fail'))
                <div class="alert alert-danger">{{Session::get('fail')}}</div>
                @endif
                @csrf
                <div class="name-register">
                    <label for="email">Your Email:</label>
                    <input type="email" name="email" id="email" placeholder="ex:  LindseyWilson@gmail.com" value="{{ old('email') }}" required />
                    <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>
                <div class="name-register">
                    <label for="Password">Password:</label>
                    <input type="password" name="password" id="password" required />
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                </div>
                <div class="name-register">
                    <label for="Password">Confirm Password:</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" required />
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                </div>
                <input type="submit" value="Register">
            </form>
        </div>
    </div>
</body>

@endsection
