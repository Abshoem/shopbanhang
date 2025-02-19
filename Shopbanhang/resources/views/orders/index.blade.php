@extends('products.layout')

@section('content')
<div class="container mt-5">
    <h1>Order List</h1>
    <table class="table">
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
                <td><img src="{{ asset($order->img) }}" alt="Order Image" width="100"></td>
                <td>{{ $order->order_time }}</td>
                <td>
                    <!-- Nút Xóa -->
                    <form action="{{ route('orders.destroy', $order->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this item?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Nút Back -->
    <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back</a>
</div>
@endsection
