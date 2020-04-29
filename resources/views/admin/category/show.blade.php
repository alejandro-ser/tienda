@extends('layouts.admin')

@section('titulo', 'Ver categoría')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route('admin.category.index')}}">Categorías</a></li>
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
<div>
    <!-- Default box -->
    <div class="card">
        <form>
            <div class="card-header">
                <h3 class="card-title">Ver de categoría</h3>

                <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
                    <i class="fas fa-times"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="nombre">Nombre</label>
                    <input value="{{ $cat->nombre }}"
                            class="form-control" type="text" name="nombre" id="nombre"
                            placeholder="Ingrese la categoría"
                            readonly>

                    <label for="slug">Slug</label>
                    <input v-model="generarSlug"
                            value="{{ $cat->slug }}"
                            class="form-control" type="text" name="slug" id="slug"
                            readonly>

                    <label for="descripcion">Descripción</label>
                    <textarea class="form-control"
                                name="descripcion"
                                id="descripcion"
                                cols="30" rows="10"
                                readonly>
                        {{ $cat->descripcion }}
                    </textarea>
                </div>
            </div>
            <!-- /.card-body -->
            <div class="card-footer">
                <a href="{{ route('cancelar','admin.category.index') }}" class="btn btn-danger">Cancelar</a>
                <a href="{{ route('admin.category.edit',$cat->slug) }}" class="btn btn-info float-right">Editar</a>
            </div>
            <!-- /.card-footer-->
        </form>
    </div>
    <!-- /.card -->
</div>
@endsection