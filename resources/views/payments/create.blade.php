@extends("layouts.app")

@section("content")
    <h1>Detalle del Pago</h1>
    <h4 class="text-center"><strong>Total:</strong> {{ $order->total }}</h4>
    <div class="text-center mb-3">
        <form action="{{ route("orders.payments.store", ["order" => $order->id])}}" method="post" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Pagar</button>
        </form>
    </div>
@endsection