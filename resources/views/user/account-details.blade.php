<!-- resources/views/account/details.blade.php -->
@extends('layouts.app')

@section('content')
<section>
    <!-- ACCOUNT DETAILS -->
    <div class="container account-details">
        <h1>Account Details</h1>
        <div class="row">
            <div class="col-md-6">
                <form method="POST" action="{{ route('account.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Picture -->
                    <div class="form-group mb-3">
                        <label for="profile_picture">Profile Picture</label>
                        <input type="file" class="form-control" id="profile_picture" name="profile_picture">
                    </div>

                     <!-- First Name -->
                    <div class="form-group mb-3">
                        <label for="first_name">First Name</label>
                        <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}">
                    </div>

                    <!-- Last Name -->
                    <div class="form-group mb-3">
                        <label for="phone_number">Last Name</label>
                        <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}">
                    </div>

                     <!-- Phone Number -->
                    <div class="form-group mb-3">
                        <label for="phone_number">Phone Number</label>
                        <input type="text" class="form-control" id="phone_number" name="phone_number" value="{{ $user->phone_number }}">
                    </div>

                    <!-- Username -->
                    <div class="form-group mb-3">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $user->username }}">
                    </div>


                    <!-- Email Address -->
                    <div class="form-group mb-3">
                        <label for="email">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                    </div>


                    <!-- Password -->
                    <div class="form-group mb-3">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>

                    <!-- Confirm Password -->
                    <div class="form-group mb-3">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
                    </div>

                    <!-- Update Button -->
                    <button type="submit" class="btn ">Update Account</button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection