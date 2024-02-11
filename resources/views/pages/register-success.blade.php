@extends('layouts.app')

@section('content')
<section>
    <div class="container welcome mt-5 text-center">
        <h1>Welcome to Amala24/7</h1>
        <p>Thank you for signing up. We're excited to have you here!</p>
        <p>
            <a class="btn btn-outline-danger" href="{{ route('login') }}">Login</a>
        </p>
    </div>
</section>
@endsection