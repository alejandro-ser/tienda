<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Category;

class AdminCategoryController extends Controller
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

        $categorias = Category::where('nombre','like',"%$nombre%")->orderBy('nombre')->paginate(4);

        return view('admin.category.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$cat = new Category();
        $cat->nombre        = $request->nombre;
        $cat->slug          = $request->slug;
        $cat->descripcion   = $request->descripcion;
        $cat->save();*/

        $request->validate([
            'nombre' => 'required|max:50|min:3|unique:categories,nombre',
            'slug' => 'required|max:50|min:3|unique:categories,slug'
        ]);

        Category::create($request->all());

        return redirect()->route('admin.category.index')->with('datos', 'Categpría creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cat = Category::where('slug', $slug)->firstOrFail();

        return view('admin.category.show', compact('cat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cat = Category::where('slug', $slug)->firstOrFail();

        return view('admin.category.edit', compact('cat'));
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
        /*$cat->nombre        = $request->nombre;
        $cat->slug          = $request->slug;
        $cat->descripcion   = $request->descripcion;
        $cat->save();*/

        $cat = Category::findOrFail($id);

        $request->validate([
            'nombre' => 'required|max:50|min:3|unique:categories,nombre,'.$cat->id,
            'slug' => 'required|max:50|min:3|unique:categories,slug,'.$cat->id
        ]);

        $cat->fill($request->all())->save();

        //return $cat;

        return redirect()->route('admin.category.index')->with('datos', 'Registro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $cat = Category::findOrFail($id);
        $cat->delete();

        return redirect()->route('admin.category.index')->with('datos', 'Registro eliminado correctamente');
    }
}
