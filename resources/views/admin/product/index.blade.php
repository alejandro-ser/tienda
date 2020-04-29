@extends('layouts.admin')

@section('titulo', 'Admnistración de productos')

@section('breadcrumb')
  <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')

<!-- /.row -->
<div id="confirmarEliminar" class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <a href="{{ route('admin.product.create') }}" class="btn btn-success btn-sm">Crear producto</a>

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
                @foreach ($productos as $producto)
                    <tr>
                        <td>{{$producto->id}}</td>
                        <td>{{$producto->nombre}}</td>
                        <td>{{$producto->slug}}</td>
                        <td>{{$producto->descripcion}}</td>
                        <td>{{$producto->created_at}}</td>
                        <td>{{$producto->updated_at}}</td>

                        <td><a href="{{ route('admin.product.show', $producto->slug) }}"
                                class="btn btn-default btn-sm">
                              <i class="far fa-eye"></i>
                            </a></td>
                        <td><a href="{{ route('admin.product.edit', $producto->slug) }}"
                                class="btn btn-info btn-sm">
                                <i class="far fa-edit"></i>
                            </a></td>
                        <td><a href="{{ route('admin.product.index', $producto->slug) }}"
                                v-on:click.prevent="deseasEliminar({{$producto->id}})"
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
            {{ $productos->appends($_GET)->links() }}
        </div>
      </div>
      <!-- /.card -->
    </div>

    <span style="display:none;" id="urlBase">{{ route('admin.product.index') }}</span>

    @include('custom.modal_eliminar')

</div>
<!-- /.row -->

@endsection