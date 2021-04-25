@extends('layouts.master')
@section('custom-css')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card card-profile" style="height: 550px;">
                <div class="card-avatar">
                    <a href="javascript:;">
                        @if($patient->image)
                            <img class="img" src="{{ asset($patient->image) }}" />
                        @else
                            <img class="img" src="{{ asset('/storage/uploads/p.png') }}" />
                        @endif
                    </a>
                </div>
                <div class="card-body">
                    <ul>
                        <li style="text-align: left">Nom : {{ $patient->name }}</li>
                        <li style="text-align: left">Sexe : {{ $patient->gender }}</li>
                        <li style="text-align: left">Email: {{ $patient->email }}</li>
                        <li style="text-align: left">Télephone : {{ $patient->phone }}</li>
                        <li style="text-align: left">Adresse : {{ $patient->adress }}</li>
                    </ul>
                </div>
                <div class="card-body">
                    @if(!$patient->medical_file->file)
                        <form method="POST" enctype="multipart/form-data" action="{{ route('add.file')}}">
                        @csrf
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>
                                {{ $error }}
                            </span>
                            </div>
                        @endforeach
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <i class="material-icons">close</i>
                                </button>
                                <span>
                                {!! \Session::get('success') !!}
                            </span>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <label>Ajouter le dossier medicale</label><br>
                                <input type="file" name="image"> <button type="submit" class="btn btn-info pull-right">Ajouter</button>
                            </div>
                            <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                        </div>
                    </form>
                    @else
                        <form method="POST" enctype="multipart/form-data" action="{{ route('update.file')}}">
                            @csrf
                            @foreach ($errors->all() as $error)
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>
                                {{ $error }}
                            </span>
                                </div>
                            @endforeach
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <i class="material-icons">close</i>
                                    </button>
                                    <span>
                                {!! \Session::get('success') !!}
                            </span>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-md-12">
                                    <label>Modifier le dossier medicale</label><br>
                                    <input type="file" name="image"> <button type="submit" class="btn btn-info pull-right">Ajouter</button>
                                </div>
                                <input type="hidden" name="patient_id" value="{{ $patient->id }}">
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card card-profile">
                <img id="viewer" src="{{ asset($patient->medical_file->file) }}" alt="Dossier Medicale" height="550">
                <div id="info"> </div>
            </div>
        </div>
    </div>
@endsection
@section('custom-js')
    <script src="{{ asset('js/jquery.imageviewer.min.js') }}"></script>
    <script>
        imageviewer();
    </script>
@endsection
