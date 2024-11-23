@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Creacion de aula'])
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
                                            @method('POST')
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label for="">Nombre del aula</label>
                                                    <input type="text" name="nombre" id="nombre"
                                                        placeholder="Nombre aula" class="form-control" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Capacidad del aula</label>
                                                    <input type="number" name="capacidad" id="capacidad" class="form-control" placeholder="0" required>
                                                </div>
                                                <div class="col-md-4">
                                                    <label for="">Ubicacion del aula</label>
                                                    <input type="text" name="ubicacion" id="ubicacion"
                                                        placeholder="Ubicacion aula" class="form-control" required>
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

            console.log();

            submit_with_ajax("{{ route('aulas.store') }}", 'POST', parameters,
                function(data) {
                    Swal.fire({
                        title: 'Alerta',
                        text: data.message,
                        icon: 'success',
                        timer: 1000,
                        onClose: () => {
                            location.href = "{{ route('aulas.index') }}";
                        }
                    });
                });
        });
    </script>
@endpush