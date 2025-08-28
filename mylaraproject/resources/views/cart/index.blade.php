@extends('layouts.app')

@section('content')
<h2>Your Cart</h2>

@if(empty($cart) || count($cart) === 0)
    <div class="alert alert-info text-center">
        Your cart is empty.
    </div>
    <div class="text-center">
        <a href="{{ route('products.index') }}" class="btn btn-primary mt-3">
            🛒 Add Products
        </a>
    </div>
@else
    <table class="table table-striped align-middle">
        <thead>
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>Subtotal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach($cart as $id => $item)
            <tr>
                <td>
                    @if(isset($item['image_url']))
                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" style="width: 60px; height: 60px; object-fit: cover; border-radius: 5px;">
                    @else
                        <span class="text-muted">No Image</span>
                    @endif
                </td>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['quantity'] }}</td>
                <td>${{ $item['price'] }}</td>
                <td>${{ $item['price'] * $item['quantity'] }}</td>
                <td>
                    <form action="{{ route('cart.remove', $id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h4>Total: ${{ $total }}</h4>

    <div class="d-flex gap-2 mt-3">
        <form action="{{ route('cart.clear') }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">Clear Cart</button>
        </form>

        <a href="{{ route('products.index') }}" class="btn btn-success">
            Continue Shopping
        </a>
    </div>
@endif
@endsection
