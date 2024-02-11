@extends('layouts.app')

@section('content')
    <section>
        <div class="container shipping-view">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h1 class="mb-0"> This Is Your Shipping Address</h1>
                        </div>

                        <div class="card-body">
                            @if($user->userAddress)
                                <div class="mb-4">
                                    <strong>Street Address:</strong>
                                    <p class="mb-0">{{ $user->userAddress->street_address }}</p>
                                </div>

                                <div class="mb-4">
                                    <strong>House Number:</strong>
                                    <p class="mb-0">{{ $user->userAddress->house_number }}</p>
                                </div>

                                <div class="mb-4">
                                    <strong>City:</strong>
                                    <p class="mb-0">{{ $user->userAddress->city }}</p>
                                </div>

                                <div class="mb-4">
                                    <strong>State:</strong>
                                    <p class="mb-0">{{ $user->userAddress->state }}</p>
                                </div>
                                
                                <div class="mb-4">
                                    <strong>Country:</strong>
                                    <p class="mb-0">{{ $user->userAddress->country }}</p>
                                </div>
                            @else
                                <p>No shipping address found.</p>
                            @endif

                            <a href="{{ route('address-edit') }}" class="btn btn-primary">Edit Shipping Address</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


