@extends('products.layout')

@section('content')

<div class="card mt-5">
    <h2 class="card-header">Add New Product</h2>
    <div class="card-body">

        <div class="d-grid gap-2 d-md-flex justify-content-md-start mb-4">
            <a class="btn btn-outline-secondary btn-sm" href="{{ route('categories.index') }}">
                <i class="fa fa-arrow-left"></i> Back to Categories
            </a>
        </div>

        <!-- Thay đổi action để truyền categoryId -->
        <form action="{{ route('categories.storeProduct', ['categoryId' => $categoryId]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="inputName" class="form-label"><strong>Name:</strong></label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="inputName"
                    placeholder="Name">
                @error('name')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputDetail" class="form-label"><strong>Detail:</strong></label>
                <textarea class="form-control @error('detail') is-invalid @enderror" style="height:150px" name="detail"
                    id="inputDetail" placeholder="Detail"></textarea>
                @error('detail')
                <div class="form-text text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="inputPrice" class="form-label"><strong>Price:</strong></label>
                <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                    id="inputPrice" placeholder="Price">
                @error('price')
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
            </div>

            <button type="submit" class="btn btn-success"><i class="fa-solid fa-floppy-disk"></i> Submit</button>
        </form>

    </div>
</div>
@endsection