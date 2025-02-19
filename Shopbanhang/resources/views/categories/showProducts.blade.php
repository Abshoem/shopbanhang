@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Products</h2>
    <div class="card-body">

        @session('success')
        <div class="alert alert-success" role="alert"> {{ $value }} </div>
        @endsession

        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('categories.index') }}">
                <i class="fa fa-arrow-left"></i> Back to Categories
            </a>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-success btn-sm" href="{{ route('categories.createProduct',  $category->id) }}"> <i
                    class="fa fa-plus"></i> Create
                New Product</a>
        </div>

        <table class="table table-bordered table-striped mt-4">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Name</th>
                    <th>Details</th>
                    <th>Price</th>
                    <th>Image</th>
                    <th>Size</th> <!-- Thêm cột Size -->
                    <th>Material</th> <!-- Thêm cột Material -->
                    <th>Frame</th> <!-- Thêm cột Frame -->
                    <th>Condition</th> <!-- Thêm cột Condition -->
                    <th width="250px">Action</th>
                </tr>
            </thead>

            <tbody>
                @php $i = 1; @endphp
                <!-- Khởi tạo biến $i -->
                @forelse ($products as $product)
                <tr>
                    <td>{{ $i++ }}</td> <!-- Sử dụng $i và tăng giá trị -->
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->detail }}</td>
                    <td>{{ $product->price }} </td>
                    <td>
                        @if($product->image)
                        <img src="{{ asset($product->image) }}" alt="Product Image" class="img-thumbnail" width="100">
                        @else
                        <span>No Image</span>
                        @endif
                    </td>
                    <td>{{ $product->size }}</td> <!-- Hiển thị Size -->
                    <td>{{ $product->material }}</td> <!-- Hiển thị Material -->
                    <td>{{ $product->frame ? 'Yes' : 'No' }}</td> <!-- Hiển thị Frame (Yes/No) -->
                    <td>{{ $product->condition }}</td> <!-- Hiển thị Condition -->
                    <td>
                        <form action="{{ route('products.destroy',$product->id) }}" method="POST">

                            <!-- <a class="btn btn-info btn-sm" href="{{ route('products.show',$product->id) }}"><i
                                    class="fa-solid fa-list"></i> Show</a> -->

                            <a class="btn btn-primary btn-sm" href="{{ route('products.edit',$product->id) }}"><i
                                    class="fa-solid fa-pen-to-square"></i> Edit</a>

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i>
                                Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="10">There are no data.</td>
                </tr>
                @endforelse
            </tbody>

        </table>

        {!! $products->links() !!}

    </div>
</div>
@endsection