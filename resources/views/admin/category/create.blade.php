@extends('layouts.admin')

@section('titulo', 'Crear categoría')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categorías</a></li>
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
<div id="apiCategory">
    <!-- Default box -->
    <div class="card">
        <form action="{{ route('admin.category.store') }}" method="POST">
            @csrf
            <div class="card-header">
                <h3 class="card-title">Administración de categorias</h3>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input v-model="nombre"
                            @blur="getCategory"
                            @focus="div_aparecer = false"
                            class="form-control" type="text" name="nombre" id="nombre"
                            placeholder="Ingrese la categoría">
                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                        @{{ div_mensaje_category }}
                    </div>
                    <br v-if="div_aparecer">
                    <label for="slug">Slug</label>
                    <input v-model="generarSlug" readonly class="form-control" type="text" name="slug" id="slug">
                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                        @{{ div_mensajeslug }}
                    </div>
                    <br v-if="div_aparecer">
                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control" name="descripcion" id="descripcion" cols="30" rows="10"></textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('cancelar','admin.category.index') }}" class="btn btn-danger">Cancelar</a>
                <input :disabled="deshabilitar_boton == 1"
                        type="submit" value="Guardar" class="btn btn-primary float-right">
            </div>
            <!-- /.card-footer-->
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection