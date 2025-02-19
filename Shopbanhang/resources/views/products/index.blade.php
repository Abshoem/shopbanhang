@extends('products.layout')

@section('content')

<div class="container mt-5">
    <!-- Header Section -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
  <div class="container">
    <!-- Thương hiệu (Brand) -->
    <a class="navbar-brand d-flex flex-column" href="#">
      <h1 class="display-4 text-primary font-weight-bold mb-0">BrainyReads</h1>
      <small class="text-muted">Sách không chỉ giúp ta hiểu thêm về thế giới, mà còn giúp ta hiểu rõ hơn về chính mình.</small>
    </a>

    <!-- Nút toggler cho màn hình nhỏ -->
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
          <form action="{{ route('logout') }}" method="GET" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
          </form>
        </li>
      </ul>
    </div>
  </div>
</nav>



    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success" role="alert">{{ session('success') }}</div>
    @endif

    <!-- Search Bar -->
    <div class="row mb-5">
        <div class="col-lg-6 mx-auto">
            <div class="input-group rounded shadow-sm">
                <input type="text" class="form-control" name="search" placeholder="Search for products..."
                    value="{{ request('search') }}">
                <button type="submit" class="btn btn-dark">Search</button>
            </div>
        </div>
    </div>



    <!-- Featured Products (Carousel) -->
    <div id="featuredProductsCarousel" class="carousel slide" data-bs-ride="carousel">
    <!-- <div class="carousel-inner">
        @foreach ($products->take(5) as $product)
        <div class="carousel-item @if($loop->first) active @endif">
            @if($product->image)
            <img src="{{ asset($product->image) }}" class="d-block w-100 vh-100" alt="Product Image" style="object-fit: cover;">
            @else
            <img src="https://via.placeholder.com/1200x600" class="d-block w-100 vh-100" alt="Placeholder Image" style="object-fit: cover;">
            @endif
            <div class="carousel-caption d-none d-md-block">
                <h3 class="display-5">{{ Str::limit($product->name, 40) }}</h3>
                <a href="{{ route('products.showdetail2', $product->id) }}" class="btn btn-primary btn-lg">View Details</a>
            </div>
        </div>
        @endforeach
    </div> -->
    <!-- Controls -->
    <button class="carousel-control-prev" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#featuredProductsCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>


     <!-- Category Section -->
     <div class="category-section mb-5">
        <h5>Danh sách sản phẩm</h5>
        @php
        $colors = ['btn-primary', 'btn-secondary', 'btn-success', 'btn-danger', 'btn-warning', 'btn-info', 'btn-dark'];
        @endphp

        <div class="d-flex flex-wrap justify-content-start gap-3 mt-3">
            @foreach ($categories as $index => $category)
                <a href="{{ route('products.index', ['category' => $category->id]) }}"
                    class="btn {{ $colors[$index % count($colors)] }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

    </div>


    <!-- Filters Section -->
    <div class="row mb-4">
        <!-- <div class="col-md-3">
            <h5 class="text-center">Filters</h5>
            <form action="{{ route('products.index') }}" method="GET">
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select name="category" id="category" class="form-select">
                        <option value="">All Categories</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="home">Home</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price Range</label>
                    <input type="number" name="min_price" class="form-control" placeholder="Min Price"
                        value="{{ request('min_price') }}">
                    <input type="number" name="max_price" class="form-control mt-2" placeholder="Max Price"
                        value="{{ request('max_price') }}">
                </div>
                <button type="submit" class="btn btn-dark w-100">Apply Filters</button>
            </form>
        </div> -->
        <div class="col-md-3 d-flex align-items-center justify-content-center">
            <img src="{{ asset($product->image) }}" alt="Product Category Image" class="img-fluid">
        </div>
        <!-- Product Listing -->

        <div class="col-md-9">
            <div class="row">
                @foreach ($products as $product)
                <div class="col-md-4 mb-4">
                    <div class="card shadow-lg border-0 rounded-lg overflow-hidden">
                        <div class="position-relative">
                            @if($product->image)
                            <img src="{{ asset($product->image) }}" alt="Product Image" class="card-img-top"
                                style="height: 200px; object-fit: cover;">
                            @else
                            <div class="d-flex justify-content-center align-items-center"
                                style="height: 200px; background: #f0f0f0;">
                                <span class="text-muted">No Image</span>
                            </div>
                            @endif
                            <div class="position-absolute top-0 start-0 p-2">
                                <span class="badge bg-primary">New</span>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title text-center">{{ Str::limit($product->name, 30) }}</h5>
                            <p class="card-text text-muted">{{ Str::limit($product->detail, 60) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <a href="{{ route('products.showdetail2', $product->id) }}"
                                    class="btn btn-dark btn-sm">View
                                    Details</a>
                                <span class="badge bg-secondary">${{ number_format($product->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-4">
                {!! $products->links() !!}
            </div>
        </div>
    </div>
    <!-- Footter -->
    <footer class="bg-light py-4">
    <div class="container">
        <div class="row">

        <!-- Logo và thông tin liên hệ -->
        <div class="col-md-3 mb-4">
            <!-- Thay đường dẫn ảnh logo tại đây -->
            <p class="mb-1">
                <strong>BrainyReads</strong><br>
                Địa chỉ VP Hà Nội: Phố Nguyễn Trác<br>
                Phường Yên Nghĩa,<br>
                Quận Hà Đông, Hà Nội
            </p>
            <p class="mb-0">
                Hotline: <a href="tel:0898657616" class="text-dark">0974838034</a>
            </p>
        </div>

        <!-- Hỗ trợ khách hàng -->
        <div class="col-md-3 mb-4">
            <h5 class="fw-bold mb-3">Hỗ trợ khách hàng</h5>
            <ul class="list-unstyled">
                <li><a href="#" class="text-decoration-none text-dark">Hướng dẫn mua hàng</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Hình thức thanh toán</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Chính sách bảo hành</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Chính sách đổi trả</a></li>
            </ul>
        </div>

        <!-- Sản phẩm -->
        <div class="col-md-3 mb-4">
            <h5 class="fw-bold mb-3">Sản phẩm</h5>
            <ul class="list-unstyled">
                <li><a href="#" class="text-decoration-none text-dark">Doanh nhân và Doanh nghiệp</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Nghệ thuật sống - Tâm lý</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Sức khỏe - Hạnh phúc</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Tài chính cá nhân</a></li>
            </ul>
        </div>

        <!-- Tin tức - Sự kiện -->
        <div class="col-md-3 mb-4">
            <h5 class="fw-bold mb-3">Tin tức - Sự kiện</h5>
            <ul class="list-unstyled">
                <li><a href="#" class="text-decoration-none text-dark">Báo chí truyền thông</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Kiến thức học tập</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Tuyển dụng</a></li>
                <li><a href="#" class="text-decoration-none text-dark">Review sách BrainyReads</a></li>
            </ul>
        </div>

    </div>
  </div>
</footer>

</div>

@endsection
