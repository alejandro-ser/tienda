<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Product;
use App\Category;

class AdminProductController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $nombre = $request->get('nombre');

        $productos = Product::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(4);

        return view('admin.product.index',compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorias = Category::orderBy('nombre')->get();

        return view('admin.product.create',compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:50|min:3|unique:products,nombre',
            'slug' => 'required|max:50|min:3|unique:products,slug',
            'imagenes.*' => 'image|mimes:jpg,jpeg,png,gif,svg|max:2048'
        ]);

        $product = New Product();
        $product->nombre = $request->nombre;
        $product->slug = $request->slug;
        $product->cantidad = $request->cantidad;
        $product->precio_actual = $request->precioactual;
        $product->precio_anterior = $request->precioanterior;
        $product->porcentaje_descuento = $request->porcentajededescuento;
        $product->descripcion_corta = $request->descripcion_corta;
        $product->descripcion_larga = $request->descripcion_larga;
        $product->especificaciones = $request->especificaciones;
        $product->datos_de_interes = $request->datos_de_interes;
        $product->estado = $request->estado;
        $product->category_id = $request->category_id;

        if ($product->activo) {
            $product->activo = 'Si';
        } else {
            $product->activo = 'No';
        }

        if ($product->sliderprincipal) {
            $product->sliderprincipal = 'Si';
        } else {
            $product->sliderprincipal = 'No';
        }

        if ($product->save()) {
            $urlImagenes = [];

            if ($request->hasFile('imagenes')) {
                $imagenes = $request->file('imagenes');

                foreach ($imagenes as $imagen) {
                    $nombre = time().'_'.$imagen->getClientOriginalName();
                    $ruta = public_path().'/img';
                    $imagen->move($ruta,$nombre);
                    $urlImagenes[]['url'] = '/img/'.$nombre;
                }
            }

            $product->images()->createMany($urlImagenes);
        }

        return redirect()->route('admin.product.index')->with('datos', 'Producto creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
