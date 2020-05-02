<?php

Route::get('/', function () {

    // Validar si un usuario tiene imagen
    $usuario = User::find(1);

    $image = $usuario->image;

    if ($image) {
        echo 'Tiene imagen';
    } else {
        echo 'No tiene imagen';
    }

    return $image;


    //01 crear imagen para usuario usando save()

    $imagen = new Image(['url' => 'img/avatar.png']);
    
    $usuario = User::find(1);

    $usuario->image()->save($imagen);

    return $usuario;

    //02 Información de la simagenes a traves del user
    $usuario = User::find(1);

    return $usuario->image->url;


    //03 crear imagene para producto usando savemany()
    
    $producto = Product::find(3);

    $producto->images()->saveMany([
        new Image(['url' => 'img/avatar.png']),
        new Image(['url' => 'img/avatar2.png']),
        new Image(['url' => 'img/avatar3.png']),
    ]);

    return $producto->images;

    //04 crear imagen para usuario usando create()
    
    $usuario = User::find(1);

    $usuario->image()->create([
        'url' => 'img/avatar2.png'
    ]);

    return $usuario;

    //05 Otra forma de guardar imagenes
    
    $imagen = [];

    $imagen['url'] = 'img/avatar3.png';

    $usuario = User::find(1);

    $usuario->image()->create($imagen);

    return $usuario;

    
    //06 Crear varias imagene spara un producto usando createMany
    
    $imagen = [];

    $imagen[]['url'] = 'img/avatar.png';
    $imagen[]['url'] = 'img/avatar2.png';
    $imagen[]['url'] = 'img/avatar3.png';
    $imagen[]['url'] = 'img/avatar04.png';

    $producto = Product::find(2);

    $producto->images()->createMany($imagen);

    return $producto->images;


    // 07 Actualizar imagen de usuario
    $usuario = User::find(1);

    $usuario->image->url = 'img/avatar2.png';

    $usuario->push();
    
    return $usuario->image;

    
    // 08 Buscar registro relacionado a la imagen
    $image = Image::find(9);

    return $image;


    // 09 Delimitar los registros
    $producto = Product::find(2);

    return $producto->images()->where('url','img/avatar2.png')->get();


    // 10 Ordenar registros de las relaciones
    $producto = Product::find(2);

    return $producto->images()->where('url','img/avatar2.png')->orderBy('id','Desc')->get();


    // 11 contar los registros relacionados
    $usuario = User::withCount('image')->get();
    $usuario = $usuario->find(1);

    return $usuario;


    // 12 contar los registros relacionados
    $productos = Product::withCount('images')->get();
    $productos = $productos->find(2);

    return $productos->images_count;


    // 13 contar los registros relacionados otra forma
    $productos = Product::find(2);
    return $productos->loadCount('images');


    // 14 carga diferida
    $producto = Product::find(2);

    $imagen = $producto->image;

    $categoria = $producto->category;


    // 15 Carga previa (eager loading)
    $productos = Product::with('images')->get();
    return $productos;


    // 16 Carga previa (eager loading)
    $usuario = User::with('image')->get();
    return $usuario;


    // 17 Carga previa de multiples relaciones
    $productos = Product::with('images','category')->get();

    return $productos;


    // 19 Delimitar campos en las relaciones
    $producto = Product::with('images:id,imageable_id,url','category:id,nombre,slug')->find(3);

    return $producto;


    // 20 Eliminar una imagen
    $producto = Product::find(3);

    $producto->images[0]->delete();

    return $producto;


    // 21 Eliminar todas las imagenes
    $producto = Product::find(2);

    $producto->images()->delete();

    return $producto;
});