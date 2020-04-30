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
        <div class="card-header">
            <h3 class="card-title">Categoría</h3>
        </div>
        <div class="card-body">
            <dl class="row">
                <dt class="col-sm-2">Nombre:</dt>
                <dd class="col-sm-10">{{ $cat->nombre }}</dd>
              
                <dt class="col-sm-2">Slug:</dt>
                <dd class="col-sm-10">{{ $cat->slug }}</dd>
              
                <dt class="col-sm-2 text-truncate">Descripción:</dt>
                <dd class="col-sm-10">{{ $cat->descripcion }}</dd>
            </dl>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
            <a href="{{ route('admin.category.index') }}" class="btn btn-danger">Volver</a>
            <a href="{{ route('admin.category.edit',$cat->slug) }}" class="btn btn-info float-right">Editar</a>
        </div>
        <!-- /.card-footer-->
    </div>
    <!-- /.card -->
</div>
@endsection