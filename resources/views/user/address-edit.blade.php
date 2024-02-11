@extends('layouts.app')

@section('content')
    <section>
        <div class="container shipping-edit">
            <h1 class="mb-4">Update Your Shipping Address</h1>
            <form action="{{ route('address.update') }}" method="POST">
                @csrf
                @method('PUT')

                <!-- Country Field (Read-only) -->
                <div class="form-group mb-3">
                    <label for="country">Country</label>
                    <input type="text" name="country" value="Nigeria" class="form-control shipping-edit" readonly>
                </div>

                <!-- State Field (Read-only) -->
                <div class="form-group mb-3">
                    <label for="state">State</label>
                    <input type="text" name="state" value="Abuja" class="form-control shipping-edit" readonly>
                </div>

                <!-- City Field with Dropdown -->
                <div class="form-group mb-3">
                    <label for="city">City</label>
                    <select name="city" class="form-control shipping-edit" required>
                        <option value="" disabled selected>Select an Option</option>
                        <option value="Gwagwalada">Gwagwalada</option>
                        <option value="Kuje">Kuje</option>
                        <option value="Abaji">Abaji</option>
                        <option value="Bwari">Bwari</option>
                        <option value="Kwali">Kwali</option>
                        <option value="Lugbe">Lugbe</option>
                        <option value="Karu">Karu</option>
                        <option value="Nyanya">Nyanya</option>
                        <option value="Jabi">Jabi</option>
                        <option value="Maitama">Maitama</option>
                        <option value="Wuse">Wuse</option>
                        <option value="Garki">Garki</option>
                        <option value="Asokoro">Asokoro</option>
                        <option value="Wuse II">Wuse II</option>
                        <option value="Utako">Utako</option>
                        <option value="Central Business District (CBD)">Central Business District (CBD)</option>
                        <option value="Kubwa">Kubwa</option>
                        <option value="Gwarimpa">Gwarimpa</option>
                        <!-- Add more cities as needed -->
                    </select>
                </div>

                <!-- Street Address, House Number, and Update Button (Unchanged) -->
                <div class="form-group mb-3">
                    <label for="street_address">Street Address</label>
                    <input type="text" name="street_address" value="{{ old('street_address', optional($user->userAddress)->street_address) }}" class="form-control shipping-edit" required>
                </div>

                <div class="form-group mb-3">
                    <label for="house_number">House Number</label>
                    <input type="text" name="house_number" value="{{ old('house_number', optional($user->userAddress)->house_number) }}" class="form-control shipping-edit" required>
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-update">Update</button>
            </form>
        </div>
    </section>
@endsection

