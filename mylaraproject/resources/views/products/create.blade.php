@if ($errors->any())
  <div class="alert alert-danger">
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif



<!DOCTYPE html>
<html>
<head>
    <title>Add Product</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm border-0 rounded-3">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Add New Product</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input name="name" class="form-control" required value="{{ old('name') }}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <input name="category" class="form-control" required value="{{ old('category') }}">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Price ($)</label>
                                <input type="number" step="0.01" name="price" class="form-control" required value="{{ old('price') }}">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" required value="{{ old('stock', 0) }}">
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label class="form-label">Image URL (optional)</label>
                            <input type="url" name="image_url" class="form-control" value="{{ old('image_url') }}">
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
                            <button class="btn btn-success">Save Product</button>
                        </div>
                    </form>
                </div>
            </div>

            @if ($errors->any())
                <div class="alert alert-danger mt-3">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $e)
                            <li>{{ $e }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>

</div>
</body>
</html>
