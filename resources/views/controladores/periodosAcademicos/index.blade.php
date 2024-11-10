@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Periodos Academicos'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-12 col-sm-12 mb-xl-0 mb-12">
                <section class="content">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header pb-2">
                                        <div class="row">
                                            <div class="col-md-6 float-start">
                                                <span class="h3">Listado</span>
                                            </div>
                                            <div class="col-md-6 d-flex justify-content-end">
                                                <a href="{{ route('periodos.create') }}" class="btn btn-success"
                                                    title="Agregar">Registrar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body p-5 pt-2">
                                        <table id="tblListado" class="table table-striped display compact row-border stripe" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Id</th>
                                                    <th>Nombre</th>
                                                    <th>Fecha inicio</th>
                                                    <th>Fecha fin</th>
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($periodos as $item)
                                                    <tr>
                                                        <td>{{ $item->id }}</td>
                                                        <td>{{ $item->nombre }}</td>
                                                        <td>{{ $item->fecha_inicio }}</td>
                                                        <td>{{ $item->fecha_fin }}</td>
                                                        <td>
                                                            <form
                                                                action="{{ route('periodos.destroy', $item->id) }}"
                                                                method="POST" class="frmEliminar">
                                                                @csrf
                                                                @method('DELETE')
                                                                <a href="{{ route('periodos.edit', $item) }}"
                                                                    class="btn btn-sm btn-primary pl-2 pr-2 pb-1 pt-1 mb-0" title="Editar">
                                                                    <i class="fa fa-pencil-square"></i>
                                                                </a>
                                                                <button class="btn btn-sm btn-danger pl-2 pr-2 pb-1 pt-1 mb-0"
                                                                    data-toggle="tooltip-top" data-placement="top"
                                                                    type="submit" title="Eliminar">
                                                                    <i class="fas fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->
                    </div>
                </section>
                <!-- /.content -->
            </div>
        </div>
    </div>
@endsection