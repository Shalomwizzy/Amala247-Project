@extends('layouts.app')

@section('content')
<div class="px-4 py-5 px-md-5 text-center text-lg-start">
    <div class="container side-text">
        <div class="row gx-lg-5 align-items-center">
            <div class="col-lg-6 mb-5 mb-lg-0">
                <h3 class="my-5 display-5 fw-bold ls-tight">
                    Register with us today and unlock incredible  <br />
                  <span class="text-danger">discount promos with your exclusive account.</span>
                </h3>
                <p style="color: hsl(217, 10%, 50.8%)">
                    Discover exclusive benefits by registering with us today. Create an account and gain access to amazing discounts and promotions that will elevate your experience at Amala 24/7. Join now and start enjoying the perks!
                </p>
            </div>
            <div class="col-lg-6 mb-5 mb-lg-0">
                <div class="card">
                    <div class="card-header">{{ __('Register') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <h1 class="mb-4 text-center">SIGN UP</h1>
                            <p class="mb-4 text-center">It's quick and easy</p>

                            <div class="row mb-3">
                                <label for="username" class="col-md-4 col-form-label text-md-end">{{ __('Username') }}</label>
                                <div class="col-md-6">
                                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">
                                    @error('username')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                </div>
                            </div>

                            <div class="form-check d-flex justify-content-center mb-4">
                                <input class="form-check-input me-2 bg-danger" type="checkbox" value="" id="form2Example33" checked />
                                <label class="form-check-label" for="form2Example33">Subscribe to our newsletter</label>
                            </div>

                            <div class="row mb-0  d-flex justify-content-center">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-outline-danger btn-block mb-4">{{ __('Register') }}</button>
                                </div>
                            </div>
                        </form>

                        <div class="d-flex justify-content-center">
                            <p class="mb-0 dont-acct">Already have an account <a href="{{ route('login') }}" class="fw-bold">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection




