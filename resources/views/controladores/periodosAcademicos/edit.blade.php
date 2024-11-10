@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Edición periodo academico'])
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
                                                <span class="h3">Datos</span>
                                            </div>

                                        </div>
                                    </div>
                                    <form role="form">
                                        <div class="card-body p-5 pt-2">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Nombre del periodo</label>
                                                    <input type="text" name="nombre" id="nombre"
                                                        placeholder="Periodo" class="form-control" value="{{ $periodo->nombre }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Fecha inicio</label>
                                                    <input type="date" name="fecha_inicio" id="fecha_inicio"
                                                        class="form-control" value="{{ $periodo->fecha_inicio }}" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Fecha fin</label>
                                                    <input type="date" name="fecha_fin" id="fecha_fin"
                                                        class="form-control" value="{{ $periodo->fecha_fin }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /.card-body -->
                                        <div class="card-footer p-2">
                                            <div class="col-md-12 d-flex justify-content-center">
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="fa fa-floppy-o" aria-hidden="true"></i>
                                                    &nbsp;
                                                    Guardar registro
                                                </button>
                                                &nbsp;
                                                &nbsp;
                                                <a href="{{ url()->previous() }}" class="btn btn-warning">
                                                    <i class="fa fa-undo" aria-hidden="true"></i>
                                                    &nbsp;
                                                    Cancelar
                                                </a>
                                            </div>
                                        </div>

                                    </form>
                                    <!-- /.card-footer -->
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


@push('js')
    <script>
        $('form').on('submit', function(e) {
            e.preventDefault();
            var parameters = new FormData(this);

            // Agregar manualmente el token CSRF y el método
            parameters.append('_token', '{{ csrf_token() }}');
            parameters.append('_method', 'PUT');

            submit_with_ajax("{{ route('periodos.update', $periodo->id) }}", 'POST', parameters,
                function(data) {
                    Swal.fire({
                        title: 'Alerta',
                        text: data.message,
                        icon: 'success',
                        timer: 1000,
                        onClose: () => {
                            location.href = "{{ route('periodos.index') }}";
                        }
                    });
                });
        });
    </script>
@endpush
