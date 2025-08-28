<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Mini Market</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

  {{-- Navbar (optional) --}}
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
      <a class="navbar-brand" href="{{ route('products.index') }}">Mini Market</a>
      <div class="collapse navbar-collapse">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('products.create') }}">Add Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('cart.index') }}">Cart</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container">
    {{-- Flash messages --}}
    @if (session('success'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    @if (session('error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
      </div>
    @endif

    {{-- Validation errors --}}
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul class="mb-0">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
    @endif

    {{-- Page content goes here --}}
    @yield('content')
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
