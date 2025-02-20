@extends('products.layout')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-3">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Products</h2>
            <a class="btn btn-light btn-sm" href="{{ route('categories.index') }}">
                <i class="fa fa-arrow-left"></i> Back to Categories
            </a>
        </div>

        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif

            <div class="mb-4 d-flex justify-content-end">
                <a class="btn btn-success btn-sm" href="{{ route('categories.createProduct',  $category->id) }}">
                    <i class="fa fa-plus"></i> Create New Product
                </a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-bordered text-center align-middle">
                    <thead class="bg-secondary text-white">
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($products as $product)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td class="fw-bold">{{ $product->name }}</td>
                            <td>{{ $product->detail }}</td>
                            <td class="text-success fw-bold">${{ number_format($product->price, 2) }}</td>
                            <td>
                                @if($product->image)
                                    <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" width="80">
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <a class="btn btn-primary btn-sm" href="{{ route('products.edit', $product->id) }}">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <form action="{{ route('products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                             Delete
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-muted py-3">There are no products available.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
</div>
@endsection
