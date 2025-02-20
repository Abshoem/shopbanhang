@extends('products.layout')

@section('content')
<div class="container-fluid px-4">
    <div class="card shadow my-5">
        <div class="card-header bg-success text-white">
            <h2 class="mb-0">Order List</h2>
        </div>
        <div class="card-body">
            <!-- Thông báo thành công (nếu có) -->
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Image</th>
                            <th>Order Time</th>
                            <th>Actions</th> <!-- Cột hành động -->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>
                            <td>${{ $order->price }}</td>
                            <td>
                                <img src="{{ asset($order->img) }}" alt="Order Image" class="img-thumbnail" style="width: 100px;">
                            </td>
                            <td>{{ $order->order_time }}</td>
                            <td>
                                <form action="{{ route('orders.destroy', $order->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm"
                                        onclick="return confirm('Are you sure you want to delete this item?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Nút Back -->
            <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back</a>
        </div>
    </div>
</div>
@endsection
