@extends("layouts.app")

@section("content")
    <h1>Detalle de la Orden</h1>
    <h4 class="text-center"><strong>Total:</strong> {{ $cart->total }}</h4>
    <div class="text-center mb-3">
        <form action="{{ route("orders.store")}}" method="post" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-success">Confirmar Orden</button>
        </form>
    </div>
    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                <tr>
                    <td>
                        <img src="{{ asset($product->images->first()->path) }}" alt="" width="100px">
                        {{$product->title}}
                    </td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->pivot->quantity}}</td>
                    <td>
                        <strong>
                            {{ $product->total }}
                        </strong>                     
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection