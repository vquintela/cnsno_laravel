<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Models\PanelProduct;
use App\Scopes\AvailableScope;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function index ()
    {
        return view("products.index")->with([
            // "products" => Product::all(),
            "products" => PanelProduct::without("images")->get(),
        ]);
    }

    public function create()
    {
        return view("products.store");
    }

    public function store(ProductRequest $request)
    {
        $product = PanelProduct::create($request->validated());
        foreach ($request->images as $image) {
            $product->images()->create([
                "path" => "images/" . $image->store("products", "images"),
            ]);
        }
        return redirect()
            ->route("products.index")
            ->withSuccess("Producto creado correctamente");
    }

    public function show(PanelProduct $product)
    {
        return view("products.show")->with([
            "product" => $product,
        ]);
    }

    public function edit(PanelProduct $product)
    {
        return view("products.edit")->with([
            "product" => $product,
        ]);
    }

    public function update(ProductRequest $request, PanelProduct $product) 
    {
        $product->update($request->validated());

        if ($request->hasFile("images")) {
            foreach ($product->images as $image) {
                $path = storage_path("app/public/{$image->path}");
                File::delete($path);
                $image->delete();
            }

            foreach ($request->images as $image) {
                $product->images()->create([
                    "path" => "images/" . $image->store("products", "images"),
                ]);
            }
            
        } 
        return redirect()
            ->route("products.index")
            ->withSuccess("Producto editado correctamente");
    }

    public function destroy(PanelProduct $product) 
    {
        $product->delete();
        return redirect()
            ->route("products.index")
            ->withSuccess("Producto eliminado correctamente");
    }
}




// redirects
// return redirect()->back()
// return redirect()->action("homeController@index")


//VAlidacion
// if($request->status == "available" && $request->stock ==0) {
        //     // session()->flash("error", "Si esta disponible tiene que tener stock");
        //     return redirect()
        //         ->back()
        //         ->withInput($request->validated())
        //         ->withErrors("Si esta disponible tiene que tener stock");
        // }


// FINDORFAIL
// public function edit(Product $product)
    // {
    //     return view("products.edit")->with([
    //         "product" => Product::findOrFail($product),
    //     ]);
    // }