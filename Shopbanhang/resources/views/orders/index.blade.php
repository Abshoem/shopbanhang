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
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->name }}</td>
                <td>${{ $order->price }}</td>
                <td><img src="{{ asset($order->img) }}" alt="Order Image" width="100"></td>
                <td>{{ $order->order_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Nút Back -->
    <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back</a>
</div>
@endsection