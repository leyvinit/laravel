<!DOCTYPE html>
<html>
<head>
    <title>{{ $product->name }} - Details</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-5">

    <a href="{{ route('products.index') }}" class="btn btn-outline-secondary mb-4">← Back to Products</a>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 rounded-3">
                @if($product->image_url)
                    <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"
                         style="object-fit:cover; max-height: 320px;">
                @endif
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start">
                        <h3 class="card-title mb-2">{{ $product->name }}</h3>
                        <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-secondary' }}">
                            {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                        </span>
                    </div>
                    <div class="text-muted mb-3">{{ $product->category }}</div>
                    <h4 class="mb-3">${{ number_format($product->price, 2) }}</h4>
                    <p class="card-text">{{ $product->description }}</p>

                    <div class="d-flex gap-2 mt-3">
                        <a href="{{ route('products.edit', $product) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" onsubmit="return confirm('Delete this product?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger">Delete</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>
</body>
</html>
