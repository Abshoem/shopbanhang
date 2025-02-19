@extends('products.layout')

@section('content')

<div class="container mt-5">
    <div class="row">
        <!-- Product Image -->
        <div class="col-md-6">
            @if($product->image)
            <img src="{{ asset($product->image) }}" class="img-fluid rounded shadow" alt="Product Image">
            @else
            <img src="https://via.placeholder.com/500x500" class="img-fluid rounded shadow" alt="Placeholder Image">
            @endif
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h1 class="display-5 text-primary">{{ $product->name }}</h1>
            <p class="text-muted">{{ $product->detail }}</p>
            <!-- <h3 class="text-success">${{ number_format($product->price, 2) }}</h3> -->
            <a href="{{ route('products.index') }}" class="btn btn-dark mt-3">Back to Products</a>
            <a href="{{ route('products.buy', $product->id) }}" class="btn btn-success mt-3">Buy</a>

        </div>
    </div>
    <!-- Product list -->
    
</div>

@endsection