<?php

use App\Product;
use App\Category;
use App\Image;
use App\User;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Para las pruebas con las imagenes
Route::get('/prueba', function () {

    // 20 Eliminar todas las imagenes
    $producto = Product::find(7);

    $producto->images;

    return $producto;
});

// Mostrar resultados
Route::get('/resultados', function () {

    $image = Image::orderBy('id','Desc')->get();

    return $image;
});

Route::get('/', function () {

    /*$prod = Product::findOrFail(2);
    $prod->nombre = 'Producto 3';
    $prod->slug = 'producto-3';
    $prod->descripcion_corta = 'Producto 3';
    $prod->descripcion_larga = 'Producto 3';
    $prod->especificaciones = 'Producto 3';
    $prod->datos_de_interes = 'Producto 3';
    $prod->estado = 'Nuevo';
    $prod->activo = 'Si';
    $prod->sliderprincipal = 'No';
    $prod->category_id = 1;
    $prod->save();
    return $prod;*/

    //return view('welcome');

    /*$cat = Category::find(2)->products;
    return $cat;*/

    return view('tienda.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/admin', function () {
    return view('layouts.admin');
})->name('admin')->middleware('auth');

Route::resource('admin/category', 'Admin\AdminCategoryController')->names('admin.category');

Route::resource('admin/product', 'Admin\AdminProductController')->names('admin.product');

Route::get('cancelar/{ruta}', function ($ruta) {
    return redirect()->route($ruta)->with('cancelar','Acción cancelada!');
})->name('cancelar');