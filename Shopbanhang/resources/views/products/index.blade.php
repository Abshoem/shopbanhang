@extends('products.layout')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-success" href="#">Sách Hay</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav align-items-center">
    <!-- Hiển thị tên user nếu đã đăng nhập -->
    @auth
    <li class="nav-item me-3">
        <span class="nav-link fw-bold text-dark">
            <i class="fas fa-user-circle text-success"></i> {{ Auth::user()->name }}
        </span>
    </li>
    @endauth

    <!-- Giỏ hàng -->
    <li class="nav-item me-3">
        <a href="{{ route('orders.index') }}" class="nav-link position-relative">
            <i class="fas fa-shopping-cart fs-5"></i>
            <span class="badge bg-danger rounded-circle position-absolute top-0 start-100 translate-middle">
                {{ $cartCount ?? 0 }}
            </span>
        </a>
    </li>

    <!-- Logout -->
    <li class="nav-item">
        <form action="{{ route('logout') }}" method="GET">
            @csrf
            <button type="submit" class="btn btn-outline-danger">Đăng xuất</button>
        </form>
    </li>
</ul>

            </div>
        </div>
    </nav>

    <!-- Spacer to offset fixed navbar -->
    <div class="pt-5"></div>

    <!-- Hiển thị thông báo -->
    @if(session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- Search Bar -->
    <div class="my-4">
        <form method="GET" action="{{ route('products.index') }}" class="d-flex">
            <input type="text" name="search" class="form-control me-2 shadow-sm" placeholder="Tìm kiếm sản phẩm..." value="{{ request('search') }}">
            <button class="btn btn-success">Tìm kiếm</button>
        </form>
    </div>

    <!-- Category Section -->
    <div class="mb-4">
        <h5 class="fw-bold">Danh mục</h5>
        <div class="d-flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-dark btn-sm shadow-sm">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Product Listing -->
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="Product Image" style="height: 230px; object-fit: cover;">
                @else
                    <div class="d-flex justify-content-center align-items-center bg-light" style="height: 230px;">
                        <span class="text-muted">Không có ảnh</span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title fw-bold text-truncate">{{ $product->name }}</h5>
                    <p class="card-text text-muted text-truncate">{{ Str::limit($product->detail, 60) }}</p>
                </div>
                <div class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                    <div class="btn-group">
                        <a href="{{ route('products.showdetail2', $product->id) }}" class="btn btn-outline-dark btn-sm">Chi tiết</a>
                        <button type="button" class="btn btn-outline-success btn-sm add-to-cart" data-url="{{ route('products.buy.products', $product->id) }}">
                            <i class="fas fa-cart-plus"></i> Thêm vào giỏ hàng
                        </button>
                    </div>
                    <span class="fw-bold text-success fs-5">${{ number_format($product->price, 2) }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {!! $products->links() !!}
    </div>

    <!-- Toast Notification -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
        <div id="cartToast" class="toast align-items-center text-white bg-success border-0" role="alert">
            <div class="d-flex">
                <div class="toast-body">Sản phẩm đã thêm vào giỏ hàng!</div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript for Toast Notification -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toastEl = document.getElementById('cartToast');
    var toast = new bootstrap.Toast(toastEl);

    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            toast.show();
            setTimeout(() => {
                window.location.href = this.getAttribute('data-url');
            }, 1500);
        });
    });
});
</script>
@endsection
