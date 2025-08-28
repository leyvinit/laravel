@if (session('success'))
  <div class="alert alert-success">{{ session('success') }}</div>
@endif
@if (session('error'))
  <div class="alert alert-danger">{{ session('error') }}</div>
@endif

<!DOCTYPE html>
<html>
<head>
    <title>Mini Market - Products</title>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body class="bg-light">
<div class="container py-5">

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('cart.index') }}" class="btn btn-outline-primary">🛒 View Cart</a>
    </div>

    <!-- Filters -->
    <form method="GET" action="{{ route('products.index') }}" class="card card-body mb-4 shadow-sm border-0">
        <div class="row g-3">
            <div class="col-md-4">
                <input type="text" name="search" class="form-control" placeholder="Search by name or description"
                       value="{{ request('search') }}">
            </div>

            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">All Categories</option>
                    @foreach ($categories as $cat)
                        <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                            {{ $cat }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2">
                <input type="number" step="0.01" name="min_price" class="form-control" placeholder="Min Price"
                       value="{{ request('min_price') }}">
            </div>

            <div class="col-md-2">
                <input type="number" step="0.01" name="max_price" class="form-control" placeholder="Max Price"
                       value="{{ request('max_price') }}">
            </div>

            <div class="col-md-3">
                <select name="sort" class="form-select">
                    <option value="">Sort: Newest</option>
                    <option value="oldest"     {{ request('sort')=='oldest' ? 'selected' : '' }}>Oldest</option>
                    <option value="name_asc"   {{ request('sort')=='name_asc' ? 'selected' : '' }}>Name A–Z</option>
                    <option value="name_desc"  {{ request('sort')=='name_desc' ? 'selected' : '' }}>Name Z–A</option>
                    <option value="price_asc"  {{ request('sort')=='price_asc' ? 'selected' : '' }}>Price Low → High</option>
                    <option value="price_desc" {{ request('sort')=='price_desc' ? 'selected' : '' }}>Price High → Low</option>
                </select>
            </div>

            <div class="col-md-9 d-flex gap-2">
                <button class="btn btn-primary">Apply</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Reset</a>
            </div>
        </div>
    </form>

    <!-- See All Products Button -->
    <div class="mb-4 text-end">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">See All Products</a>
    </div>

    @if ($products->isEmpty())
        <div class="alert alert-warning">No products found.</div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($products as $product)
                <div class="col">
                    <div class="card h-100 shadow-sm border-0 rounded-3">
                        @if($product->image_url)
                            <img src="{{ $product->image_url }}" class="card-img-top" alt="{{ $product->name }}"
                                 style="object-fit:cover; height: 180px;">
                        @endif
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-1">{{ $product->name }}</h5>
                            <div class="text-muted mb-2">{{ $product->category }}</div>
                            <p class="card-text flex-grow-1">{{ Str::limit($product->description, 100) }}</p>

                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="fw-semibold">${{ number_format($product->price, 2) }}</span>
                                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-secondary' }}">
                                    {{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }}
                                </span>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary">Details</a>
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-warning" style="padding: 0.25rem 0.5rem; font-size: 0.8rem;">Edit</a>

                                {{-- Add to Cart Button --}}
                                <form action="{{ route('cart.add', $product->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-success">Add to Cart</button>
                                </form>

                                {{-- Delete Button --}}
                                <button type="button" class="btn btn-sm btn-danger"
                                        data-bs-toggle="modal" data-bs-target="#deleteModal{{ $product->id }}">
                                    Delete
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Delete Modal -->
                <div class="modal fade" id="deleteModal{{ $product->id }}" tabindex="-1"
                     aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                      </div>
                      <div class="modal-body">
                        Do you want to delete <strong>{{ $product->name }}</strong>?
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Yes, Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $products->links() }}
        </div>
    @endif
</div>
</body>
</html>
