@extends('products.layout')

@section('content')
<div class="container-fluid px-4">
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm fixed-top py-3">
        <div class="container">
            <a class="navbar-brand fw-bold text-success fs-3" href="#">
                <i class="fas fa-book-open me-2"></i>Sách Hay
            </a>

            <!-- Right Navigation Items -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarContent">
                <ul class="navbar-nav align-items-center gap-3">
                    @auth
                    <li class="nav-item">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-user-circle me-2 text-success fs-5"></i>
                            <span class="text-dark fw-medium">{{ Auth::user()->name }}</span>
                        </div>
                    </li>
                    @endauth

                    <li class="nav-item">
                        <a href="{{ route('orders.index') }}" class="btn btn-success position-relative p-2">
                            <i class="fas fa-shopping-cart fs-5"></i>
                            <span class="badge bg-danger rounded-pill position-absolute top-0 start-100 translate-middle">
                                {{ $cartCount ?? 0 }}
                            </span>
                        </a>
                    </li>

                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="GET">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger px-4">
                                <i class="fas fa-sign-out-alt me-2"></i>Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content Container -->
    <div class="container pt-5 mt-4">
        <!-- Notifications -->
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mt-4 shadow">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif

        <!-- Search Section -->
        <div class="row justify-content-center mt-5 mb-4">
            <div class="col-md-8">
                <form method="GET" action="{{ route('products.index') }}" class="input-group shadow-lg rounded-pill">
                    <input type="text" name="search"
                           class="form-control border-0 rounded-pill ps-4 py-2"
                           placeholder="Tìm kiếm sách..."
                           value="{{ request('search') }}">
                    <button class="btn btn-success rounded-pill px-4 py-2">
                        <i class="fas fa-search me-2"></i>Tìm kiếm
                    </button>
                </form>
            </div>
        </div>

        <!-- Category Filter -->
        <div class="mb-5">
            <h4 class="fw-bold mb-4 text-secondary">Danh mục sách</h4>
            <div class="d-flex flex-wrap gap-3">
                @foreach ($categories as $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}"
                   class="btn btn-outline-success btn-lg px-4 rounded-pill shadow-sm">
                    {{ $category->name }}
                </a>
                @endforeach
            </div>
        </div>

        <!-- Product Grid -->
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
            @foreach ($products as $product)
            <div class="col">
                <div class="card h-100 border-0 shadow-hover">
                    <div class="card-img-top position-relative overflow-hidden" style="height: 300px;">
                        @if($product->image)
                        <img src="{{ asset($product->image) }}"
                             class="img-fluid w-100 h-100 object-fit-cover"
                             alt="{{ $product->name }}">
                        @else
                        <div class="d-flex justify-content-center align-items-center bg-light h-100">
                            <i class="fas fa-image fa-3x text-secondary"></i>
                        </div>
                        @endif
                        <div class="price-tag bg-success text-white px-3 py-2 position-absolute bottom-0 end-0">
                            ${{ number_format($product->price, 2) }}
                        </div>
                    </div>

                    <div class="card-body pb-0">
                        <h5 class="card-title fw-bold mb-3 text-truncate">{{ $product->name }}</h5>
                        <p class="card-text text-muted mb-4 line-clamp-3">{{ $product->detail }}</p>
                    </div>

                    <div class="card-footer bg-transparent border-0 pt-0 pb-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('products.showdetail2', $product->id) }}"
                               class="btn btn-dark px-4 rounded-pill">
                                <i class="fas fa-info-circle me-2"></i>Chi tiết
                            </a>
                            <button type="button"
                                    class="btn btn-success px-4 rounded-pill add-to-cart"
                                    data-url="{{ route('products.buy.products', $product->id) }}">
                                <i class="fas fa-cart-plus me-2"></i>Thêm
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="d-flex justify-content-center mt-5">
            {!! $products->onEachSide(1)->links() !!}
        </div>
    </div>
</div>

<!-- Toast Notification -->
<div class="position-fixed bottom-0 end-0 p-4" style="z-index: 11">
    <div id="cartToast" class="toast fade hide" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header bg-success text-white">
            <strong class="me-auto"><i class="fas fa-check-circle me-2"></i>Thành công</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast"></button>
        </div>
        <div class="toast-body bg-light-success">
            Sản phẩm đã được thêm vào giỏ hàng!
        </div>
    </div>
</div>

<style>
    .shadow-hover {
        transition: all 0.3s ease;
        transform: translateY(0);
    }

    .shadow-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.1) !important;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .price-tag {
        border-radius: 20px 0 0 20px;
        font-weight: 600;
        box-shadow: -2px 2px 8px rgba(0, 0, 0, 0.1);
    }

    .bg-light-success {
        background-color: #e8f5e9;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .object-fit-cover {
        object-fit: cover;
        object-position: center;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Toast initialization
    const toast = new bootstrap.Toast(document.getElementById('cartToast'));

    // Add to cart handler
    document.querySelectorAll('.add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();

            // Show toast
            toast.show();

            // Redirect after delay
            setTimeout(() => {
                window.location.href = this.dataset.url;
            }, 1500);
        });
    });

    // Custom pagination styling
    document.querySelectorAll('.pagination .page-link').forEach(link => {
        link.classList.add('rounded-pill', 'mx-1');
    });
});
</script>
@endsection
