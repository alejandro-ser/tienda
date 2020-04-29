@extends('plantilla.admin')

@section('titulo', 'Admnistración de categorías')

@section('breadcrumb')
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmarEliminar" class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.category.create') }}" class="btn btn-success btn-sm">Crear categoría</a>
          {{-- <h3 class="card-title">Sección categorías</h3> --}}

          <div class="card-tools">
            <form>
              <div class="input-group input-group-sm" style="width: 200px;">
                  <input type="text" name="nombre" class="form-control float-right"
                          placeholder="Buscar"
                          value="{{ request()->get('nombre') }}">

                  <div class="input-group-append">
                      <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                  </div>
              </div>
            </form>
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

                        <td><a href="{{ route('admin.category.show', $categoria->slug) }}"
                                class="btn btn-default btn-sm">
                              <i class="far fa-eye"></i>
                            </a></td>
                        <td><a href="{{ route('admin.category.edit', $categoria->slug) }}"
                                class="btn btn-info btn-sm">
                                <i class="far fa-edit"></i>
                            </a></td>
                        <td><a href="{{ route('admin.category.index', $categoria->slug) }}"
                                v-on:click.prevent="deseasEliminar({{$categoria->id}})"
                                class="btn btn-danger btn-sm">
                                <i class="far fa-trash-alt"></i>
                            </a></td>
                    </tr>
                @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer bg-transparent">
            {{ $categorias->appends($_GET)->links() }}
        </div>
      </div>
      <!-- /.card -->
    </div>

    <span style="display:none;" id="urlBase">{{ route('admin.category.index') }}</span>

    @include('custom.modal_eliminar')

</div>
<!-- /.row -->

@endsection