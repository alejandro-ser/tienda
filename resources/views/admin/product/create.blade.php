@extends('layouts.admin')

@section('titulo', 'Crear producto')

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">Productos</a></li>
    <li class="breadcrumb-item active">@yield('titulo')</li>
@endsection

@section('contenido')
<div id="apiProduct">
    <form action="{{ route('admin.product.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- SELECT2 EXAMPLE -->
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Datos generados automáticamente</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Visitas</label>
                                    <input class="form-control" type="number" id="visitas" name="visitas">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Ventas</label>
                                    <input class="form-control" type="number" id="ventas" name="ventas">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->
                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Datos del producto</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input v-model="nombre"
                                            @blur="getProduct"
                                            @focus="div_aparecer = false"
                                            class="form-control" type="text" name="nombre" id="nombre"
                                            placeholder="Ingrese el producto">
                                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                                        @{{ div_mensaje_product }}
                                    </div>
                                    <br v-if="div_aparecer">

                                    <label>Slug</label>
                                    <input v-model="generarSlug" readonly class="form-control" type="text" id="slug" name="slug">
                                    <div v-if="div_aparecer" v-bind:class="div_clase_slug">
                                        @{{ div_mensajeslug }}
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Categoría</label>
                                    <select name="category_id" class="form-control select2" style="width: 100%;">
                                        @foreach($categorias as $categoria)
                                            @if($loop->first)
                                                <option value="{{ $categoria->id }}" selected="selected">
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @else
                                                <option value="{{ $categoria->id }}">
                                                    {{ $categoria->nombre }}
                                                </option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <label>Cantidad</label>
                                    <input class="form-control" type="number" id="cantidad" name="cantidad">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>

                <!-- /.card -->
                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Sección de Precios</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio anterior</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input class="form-control" type="number" id="precioanterior" name="precioanterior"
                                            min="0" value="0" step=".01">
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Precio actual</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">$</span>
                                        </div>
                                        <input class="form-control" type="number" id="precioactual" name="precioactual"
                                            min="0" value="0" step=".01">
                                    </div>
                                    <br>
                                    <span id="descuento"></span>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Porcentaje de descuento</label>
                                    <div class="input-group">
                                        <input class="form-control" type="number" id="porcentajededescuento"
                                            name="porcentajededescuento" step="any" min="0" min="100" value="0">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">%</span>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="progress">
                                        <div id="barraprogreso" class="progress-bar" role="progressbar" style="width: 10%;"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">10%</div>
                                    </div>
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->

                        </div>
                        <!-- /.row -->

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="row">
                    <div class="col-md-6">

                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Descripciones del producto</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Descripción corta:</label>
                                    <textarea class="form-control" name="descripcion_corta" id="descripcion_corta"
                                        rows="3"></textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>Descripción larga:</label>
                                    <textarea class="form-control" name="descripcion_larga" id="descripcion_larga"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col-md-6 -->

                    <div class="col-md-6">

                        <div class="card card-info">
                            <div class="card-header">
                                <h3 class="card-title">Especificaciones y otros datos</h3>
                            </div>
                            <div class="card-body">
                                <!-- Date dd/mm/yyyy -->
                                <div class="form-group">
                                    <label>Especificaciones:</label>
                                    <textarea class="form-control" name="especificaciones" id="especificaciones"
                                        rows="3"></textarea>
                                </div>
                                <!-- /.form group -->

                                <div class="form-group">
                                    <label>Datos de interes:</label>
                                    <textarea class="form-control" name="datos_de_interes" id="datos_de_interes"
                                        rows="5"></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </div>
                    <!-- /.col-md-6 -->

                </div>
                <!-- /.row -->

                <div class="card card-warning">
                    <div class="card-header">
                        <h3 class="card-title">Imágenes</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <div class="form-group">
                            <label for="imagenes">Añadir imágenes</label>
                            <input type="file" class="form-control-file"
                                    name="imagenes[]" id="imagenes[]" multiple accept="image/*">

                            <div class="description">
                                <small>Un número ilimitado de imagenes pueden ser cargados en este campo</small>
                                <br>
                                <small>Límite de 2048Kb por imagen</small>
                                <br>
                                <small>Tipos permitidos: jpg, jpeg, png, gif, svg</small>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title">Administración</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Estado</label>
                                    <input class="form-control" type="text" id="estado" name="estado" value="Nuevo">
                                </div>
                                <!-- /.form-group -->
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-6">
                                <!-- checkbox -->
                                <div class="form-group clearfix">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="activo" name="activo">
                                        <label class="custom-control-label" for="activo">Activo</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="sliderprincipal"
                                            name="sliderprincipal">
                                        <label class="custom-control-label" for="sliderprincipal">Aparece en el Slider
                                            principal</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.row -->
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <a class="btn btn-danger btn-block btn-lg"
                            href="{{ route('cancelar','admin.product.index') }}">Cancelar</a>
                    </div>
                    <div class="col-md-6 mb-3">
                        <input :disabled="deshabilitar_boton == 1"
                                type="submit" value="Guardar" class="btn btn-primary btn-block btn-lg">
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->

            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </form>
</div>
@endsection
