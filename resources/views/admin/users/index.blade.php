@extends('layouts.admin')

@section('content')
    <div class="container users">
        <h3 class="text-center">Registered User List</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Username</th>
                        <th>Address</th>
                        <th>Action</th> {{-- Add a column for actions --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $index => $user)
                        <tr>
                            <td>{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</td>
                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone_number }}</td>
                            <td>{{ $user->username }}</td>
                            <td>
                                @if ($user->userAddress) {{-- Check if user has an address --}}
                                    <p>
                                        {{ ucfirst($user->userAddress->street_address) }}, 
                                        {{ ucfirst($user->userAddress->house_number) }}, 
                                        {{ ucfirst($user->userAddress->city) }}, 
                                        {{ ucfirst($user->userAddress->state) }}
                                    </p>
                                @else
                                    No address available
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-primary">Edit</a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <strong class="pagination-container">{!! $users->links('pagination::bootstrap-5') !!}</strong>
        </div>
    </div>
@endsection





