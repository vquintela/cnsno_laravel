@extends("layouts.app")

@section("content")
    <h1>Crear un Producto</h1>
    <form action="{{ route("products.update", ["product" =>  $product->id]) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method("PUT")
        <div class="form-row">
            <label>Titulo</label>
            <input type="text" name="title" class="form-control" value="{{ old("title") ?? $product->title}}" required>
        </div>
        <div class="form-row">
            <label>Descripcion</label>
            <input type="text" name="description" class="form-control" value="{{ old("description") ?? $product->description}}" required>
        </div>
        <div class="form-row">
            <label>Precio</label>
            <input type="number" min="1.00" step="0.01" name="price" class="form-control" value="{{ old("price") ?? $product->price}}" required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input type="number" min="0" name="stock" class="form-control" value="{{ old("stock") ?? $product->stock}}" required>
        </div>
        <div class="form-row">
            <label>Status</label>
            <select name="status" class="custom-select" required>
                <option {{ old("status") == "available" ? "selected" : ($product->status == "available" ? "selected" : "") }} value="available">Disponible</option>
                <option {{ old("status") == "unavailable" ? "selected" : ($product->status == "unavailable" ? "selected" : "") }} value="unavailable">No disponible</option>
            </select>
        </div>
        <div class="form-row">
            <label>{{ __('Imagenes') }}</label>
            <div class="custom-file">
                <input type="file" accept="image/*" name="images[]" class="custom-file-input" multiple>
                <label class="custom-file-label">Imagenes</label>
            </div>
        </div>
        <div class="form-row">
            <button type="submit" class="btn btn-primary btn-lg">Editar Producto</button>
        </div>
    </form>
@endsection