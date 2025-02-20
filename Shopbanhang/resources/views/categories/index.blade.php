@extends('products.layout')

@section('content')
<div class="container mt-5">
    <!-- Header -->
    <div class="mb-4 text-center">
        <h1 class="display-4 text-primary">Admin Dashboard</h1>
    </div>

    <!-- Phần Danh Mục (Categories) -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h2 class="mb-0">Danh Mục</h2>
            <a href="{{ route('categories.create') }}" class="btn btn-light btn-sm">
                <i class="fa fa-plus"></i> Thêm Danh Mục
            </a>
        </div>
        <div class="card-body">
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th width="80px">No</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $i++ }}</td>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <!-- Xem sản phẩm trong danh mục -->
                                    <a href="{{ route('categories.showProducts', $category->id) }}" class="btn btn-success btn-sm">
                                        <i class="fa fa-eye"></i> Xem Sản Phẩm
                                    </a>
                                    <!-- Chỉnh sửa danh mục -->
                                    <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-info btn-sm">
                                        <i class="fa fa-edit"></i> Sửa
                                    </a>
                                    <!-- Xóa danh mục -->
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa danh mục này?');" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Xóa
                                        </button>
                                    </form>
                                    <!-- Tạo sản phẩm mới cho danh mục -->
                                    <!-- <a href="{{ route('categories.createProduct', $category->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fa fa-plus"></i> Tạo Sản Phẩm
                                    </a> -->
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Phần Đơn Hàng (Orders) -->
    <div class="card mb-5 shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h2 class="mb-0">Danh Sách Đơn Hàng</h2>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover table-bordered mb-0">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>


                            <th>Order Time</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->name }}</td>


                            <td>{{ $order->order_time }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-3">
                {{ $orders->links() }}
            </div>
            <div class="mt-4 text-end">
                <a href="{{ route('logout') }}" class="btn btn-danger">
                    <i class="fa fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
