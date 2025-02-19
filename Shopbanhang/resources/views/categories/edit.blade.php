@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Edit Category</h2>
    <div class="card-body">

        <!-- Nút quay lại danh sách -->
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <a class="btn btn-primary btn-sm" href="{{ route('categories.index') }}"><i class="fa fa-arrow-left"></i>
                Back</a>
        </div>

        <!-- Form chỉnh sửa danh mục -->
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Name:</strong></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName"
                    value="{{ old('name', $category->name) }}" placeholder="Category Name">
                @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputImage" class="form-label"><strong>Image:</strong></label>
                <input type="file" name="image" class="form-control @error('image') is-invalid @enderror"
                    id="inputImage">
                @error('image')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror

                <!-- Hiển thị ảnh hiện tại -->
                @if($category->image)
                <div class="mt-2">
                    <img src="{{ asset($category->image) }}" alt="{{ $category->name }}" width="100">
                </div>
                @endif
            </div>

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Save Changes</button>
        </form>

    </div>
</div>

@endsection