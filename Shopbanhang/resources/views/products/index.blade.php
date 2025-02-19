@extends('products.layout')

@section('content')
<div class="container mt-5">
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container">
            <!-- Thương hiệu -->
            <a class="navbar-brand" href="#">
                <h1 class="h3 text-primary mb-0">BrainyReads</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent"
                aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Nội dung navbar -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav align-items-center">
                    <!-- Giỏ hàng -->
                    <li class="nav-item me-3">
                        <a href="{{ route('orders.index') }}" class="nav-link position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                {{ $cartCount ?? 0 }}
                            </span>
                        </a>
                    </li>
                    <!-- Logout -->
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger btn-sm">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <!-- Search Bar -->
    <form method="GET" action="{{ route('products.index') }}" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" class="form-control" placeholder="Search for products..." value="{{ request('search') }}">
            <button class="btn btn-dark" type="submit">Search</button>
        </div>
    </form>

    <!-- Category Section -->
    <div class="mb-4">
        <h5 class="mb-3">Danh sách sản phẩm</h5>
        <div class="d-flex flex-wrap gap-2">
            @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}" class="btn btn-outline-primary btn-sm">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>

    <!-- Product Listing -->
    <div class="row">
        @foreach ($products as $product)
        <div class="col-md-4 mb-4">
            <div class="card h-100 border-0 shadow-sm">
                @if($product->image)
                    <img src="{{ asset($product->image) }}" class="card-img-top" alt="Product Image" style="height: 200px; object-fit: cover;">
                @else
                    <div class="d-flex justify-content-center align-items-center" style="height: 200px; background: #e9ecef;">
                        <span class="text-muted">No Image</span>
                    </div>
                @endif
                <div class="card-body">
                    <h5 class="card-title">{{ Str::limit($product->name, 30) }}</h5>
                    <p class="card-text text-muted">{{ Str::limit($product->detail, 60) }}</p>
                </div>
                <div class="card-footer bg-transparent border-top-0 d-flex justify-content-between align-items-center">
                    <div class="btn-group" role="group">
                        <a href="{{ route('products.showdetail2', $product->id) }}" class="btn btn-sm btn-outline-dark">Chi tiết</a>
                        <!-- Nút thêm giỏ hàng sử dụng button và gán sự kiện hiển thị Toast -->
                        <button type="button" class="btn btn-sm btn-outline-primary add-to-cart" data-url="{{ route('products.buy.products', $product->id) }}">
                            Thêm giỏ hàng
                        </button>
                    </div>
                    <span class="badge bg-secondary fs-6">${{ number_format($product->price, 2) }}</span>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {!! $products->links() !!}
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5 border-top">
        <div class="container">
            <div class="row">
                <!-- Thông tin liên hệ -->
                <div class="col-md-3">
                    <p>
                        <strong>BrainyReads</strong><br>
                        Địa chỉ VP Hà Nội: Phố Nguyễn Trác, Phường Yên Nghĩa,<br>
                        Quận Hà Đông, Hà Nội
                    </p>
                    <p>Hotline: <a href="tel:0974838034" class="text-dark">0974838034</a></p>
                </div>
                <!-- Hỗ trợ khách hàng -->
                <div class="col-md-3">
                    <h6>Hỗ trợ khách hàng</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Hướng dẫn mua hàng</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Thanh toán</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Bảo hành</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Đổi trả</a></li>
                    </ul>
                </div>
                <!-- Sản phẩm -->
                <div class="col-md-3">
                    <h6>Sản phẩm</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Doanh nhân & Doanh nghiệp</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Nghệ thuật sống & Tâm lý</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Sức khỏe & Hạnh phúc</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Tài chính cá nhân</a></li>
                    </ul>
                </div>
                <!-- Tin tức & Sự kiện -->
                <div class="col-md-3">
                    <h6>Tin tức & Sự kiện</h6>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-decoration-none text-dark">Báo chí</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Kiến thức</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Tuyển dụng</a></li>
                        <li><a href="#" class="text-decoration-none text-dark">Review sách</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    <!-- Toast Notification cho thêm giỏ hàng -->
    <!-- Toast Notification cho thêm giỏ hàng - đặt ở góc trên bên phải -->
    <div class="position-fixed top-0 end-0 p-3" style="z-index: 11">
      <div id="cartToast" class="toast align-items-center text-white bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
          <div class="toast-body">
            Sản phẩm đã được thêm vào giỏ hàng.
          </div>
          <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
      </div>
    </div>
</div>


<!-- JavaScript: Xử lý sự kiện nút "Thêm giỏ hàng" để hiển thị Toast -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    var toastEl = document.getElementById('cartToast');
    var toast = new bootstrap.Toast(toastEl);

    document.querySelectorAll('.add-to-cart').forEach(function(button) {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Hiển thị thông báo toast
            toast.show();
            // Sau 1.5 giây chuyển hướng đến URL thêm sản phẩm vào giỏ
            setTimeout(() => {
                window.location.href = this.getAttribute('data-url');
            }, 1500);
        });
    });
});
</script>
@endsection
