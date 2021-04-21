@extends("layouts.app")

@section("content")
    <h1>Lista de productos</h1>
    <a class="btn btn-success" href="{{ route("products.create") }}">Crear Producto</a>
    @empty($products)
        <div class="alert alert-warning">
        La lista de productos esta vacia!
        </div>
    @else
        <div class="table-responsive">
            <table class="table table-striped">
                <thead class="thead-light">
                    <tr>
                        <th>ID</th>
                        <th>Titulo</th>
                        <th>Descripcion</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>
                        <td>{{$product->description}}</td>
                        <td>{{$product->price}}</td>
                        <td>{{$product->stock}}</td>
                        <td>{{$product->status}}</td>
                        <td>
                            <a class="btn btn-link" href="{{ route("products.show", ["product" => $product->id]) }}">Mostrar</a>                            
                            <a class="btn btn-link" href="{{ route("products.edit", ["product" => $product->id]) }}">Editar</a>     
                            <form class="d-inline" action="{{ route("products.destroy", ["product" => $product->id]) }}" method="post">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-link">Eliminar</button>
                            </form>                       
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endempty
@endsection