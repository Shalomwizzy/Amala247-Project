@extends('layouts.admin')

@section('content')
    <div class="container cat-index">
        <h2>Categories</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Options</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $cat)
                        <tr>
                            <td>

                                @if ($cat->image === 'images/default.png')
                                <img src="{{ asset($cat->image) }}" alt="{{ $cat->name }}" class="img-fluid" style="max-width: 100px;">
                            @else
                                <img src="{{ asset('categories/'.$cat->image) }}" alt="{{ $cat->name }}" class="img-fluid" style="max-width: 100px;">
                            @endif
                            </td>
                            <td>{{ ucfirst($cat->name ) }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('categories.show', ['id' => $cat->id]) }}" class="btn btn-sm btn-primary">View</a>
                                    <a href="{{ route('category.edit', ['id' => $cat->id]) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form onsubmit="return confirm('Are you sure?')" 
                                        action="{{ route('category.destroy', ['id' => $cat->id]) }}"
                                        method="post" class="d-inline">
                                        @csrf 
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <strong class="pagination-container"> {!! $categories->links('pagination::bootstrap-5')  !!}</strong>
    </div>
@endsection

{{-- <style>
    .cat-index {
        padding: 20px;
    }
    .table-responsive {
        overflow-x: auto;
    }
</style> --}}

