@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard'])
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="numbers">
                                    <a href="{{ route('aulas.index') }}" class="btn btn-primary">Aulas</a>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="numbers">
                                    <a href="{{ route('aulas.index') }}" class="btn btn-primary">Aulas</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        @include('layouts.footers.auth.footer')
    </div>
@endsection

@push('js')
    <script src="./assets/js/plugins/chartjs.min.js"></script>
@endpush
