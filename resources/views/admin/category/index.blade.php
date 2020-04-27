@extends('plantilla.admin')

@section('titulo', 'Admnistración de categorías')

@section('contenido')

<!-- /.row -->
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Sección categorías</h3>

          <div class="card-tools">
            <div class="input-group input-group-sm" style="width: 200px;">
                <a href="{{ route('admin.category.create') }}" class="btn btn-primary btn-sm mr-2">Crear</a>
                <input type="text" name="table_search" class="form-control float-right" placeholder="Buscar">

                <div class="input-group-append">
                    <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                </div>
            </div>
          </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 300px;">            
            <table class="table table-head-fixed text-nowrap">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Slug</th>
                <th>Descripción</th>
                <th>Fecha creación</th>
                <th>Fecha modificación</th>
                <th colspan="3" class="text-center">Acciones</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($categorias as $categoria)
                    <tr>
                        <td>{{$categoria->id}}</td>
                        <td>{{$categoria->nombre}}</td>
                        <td>{{$categoria->slug}}</td>
                        <td>{{$categoria->descripcion}}</td>
                        <td>{{$categoria->created_at}}</td>
                        <td>{{$categoria->updated_at}}</td>

                        <td><a href="{{ route('admin.category.show', $categoria->slug) }}" class="btn btn-default">Ver</a></td>
                        <td><a href="{{ route('admin.category.edit', $categoria->slug) }}" class="btn btn-info">Editar</a></td>
                        <td><a href="{{ route('admin.category.index', $categoria->slug) }}" class="btn btn-danger">Eliminar</a></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-transparent">
            {{ $categorias->links() }}
        </div>
      </div>
      <!-- /.card -->
    </div>
</div>
<!-- /.row -->

@endsection