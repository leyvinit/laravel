<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Car Selector</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        body {
            background: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .card {
            border-radius: 12px;
            box-shadow: 0 6px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 25px rgba(0,0,0,0.15);
        }
        .car-price {
            font-weight: 700;
            color: #2c7be5;
        }
        .form-select {
            max-width: 400px;
            margin: 0 auto 40px auto;
            border-radius: 50px;
            box-shadow: 0 2px 10px rgba(44,123,229,0.15);
            border: none;
            padding: 12px 20px;
            font-weight: 600;
            font-size: 1.1rem;
        }
        h2, h3 {
            text-align: center;
            margin-bottom: 30px;
            color: #343a40;
        }
        .alert {
            max-width: 500px;
            margin: 0 auto 20px auto;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Select a Person to See Their Cars</h2>

    <form method="GET" action="{{ url('/cars') }}" class="d-flex justify-content-center">
        <select name="user_id" onchange="this.form.submit()" class="form-select" required>
            <option value="" disabled selected>-- Select a user --</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}" {{ (isset($selectedUser) && $selectedUser->id == $user->id) ? 'selected' : '' }}>
                    {{ $user->name }} (Age: {{ $user->age ?? 'N/A' }})
                </option>
            @endforeach
        </select>
    </form>

    @if ($message)
        <div class="alert alert-warning text-center">
            {{ $message }}
        </div>
    @endif

    @if ($cars && $cars->count() > 0)
        <h3>Cars for {{ $selectedUser->name }}</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4">
            @foreach($cars as $car)
                <div class="col">
                    <div class="card p-3">
                        <div class="card-body">
                            <h5 class="card-title">{{ $car->car_name }}</h5>
                            <p class="mb-1"><strong>Make:</strong> {{ $car->make }}</p>
                            <p class="mb-1"><strong>Year:</strong> {{ $car->year }}</p>
                            <p class="car-price">$ {{ number_format($car->price, 2) }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @elseif (isset($selectedUser) && $selectedUser->age >= 16 && $cars->count() == 0)
        <p class="text-center text-muted mt-4">No cars found for {{ $selectedUser->name }}.</p>
    @endif
</div>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
