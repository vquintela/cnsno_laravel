@extends("layouts.app")

@section("content")
    <h1>Tu Carrito</h1>
    @if(!isset($cart) || $cart->products->isEmpty())
        <div class="alert alert-warning">
            Carrito Vacio
        </div>
    @else
        <h4 class="text-center">Total Carrito: <strong>{{ $cart->total }}</strong></h4>
        <a class="btn btn-success mb-3" href="{{ route("orders.create") }}">Comprar</a>
        <div class="row">
            @foreach ($cart->products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endif
@endsection