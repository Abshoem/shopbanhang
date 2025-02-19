@extends('products.layout')

@section('content')

<div class="container mt-5">
    <h1>Categories</h1>

    <!-- Nút tạo danh mục mới -->
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a class="btn btn-success btn-sm" href="{{ route('categories.create') }}"><i class="fa fa-plus"></i> Add New
            Category</a>
    </div>

    <!-- Hiển thị thông báo thành công nếu có -->
    @if(session('success'))
    <div class="alert alert-success mt-3">
        {{ session('success') }}
    </div>
    @endif

    <!-- Bảng danh sách các danh mục -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th width="80px">No</th>
                <th>Name</th>
                <!-- <th>Image</th> -->
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 1; @endphp
            @foreach($categories as $category)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $category->name }}</td>
                <!-- <td>
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="50">
                </td> -->
                <td>
                    <!-- Nút xem sản phẩm của danh mục -->
                    <a href="{{ route('categories.showProducts', $category->id) }}" class="btn btn-success btn-sm">View
                        Products</a>

                    <!-- Nút chỉnh sửa danh mục -->
                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">Edit</a>

                    <!-- Nút xóa danh mục -->
                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                        style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Are you sure you want to delete this category?')">Delete</button>
                    </form>

                    <!-- Nút tạo sản phẩm mới cho danh mục này -->
                    <a href="{{ route('categories.createProduct',  $category->id) }}" class="btn btn-outline-secondary btn-sm">Create
                        Product</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Hiển thị phân trang -->
    <div class="mt-3">
        {{ $categories->links() }}
    </div>
</div>

<!-- Phần đơn hàng (Order List) -->
<div class="container mt-5">
    <h1>Order List</h1>



    <!-- Bảng danh sách đơn hàng -->
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>Name</th>


                <th>Email</th>
                <th>Price</th>
                <th>Order Time</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->name }}</td>


                <td>{{ $order->email }}</td>
                <td>${{ $order->price }}</td>
                <td>{{ $order->order_time }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Phân trang -->
    <div class="mt-3">
        {{ $orders->links() }}
    </div>

    <!-- Nút Logout -->
    <div class="mt-3">
        <a href="{{ route('logout') }}" class="btn btn-danger">Logout</a>
    </div>
</div>

@endsection
