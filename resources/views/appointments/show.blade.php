@extends('layouts.master')
@section('custom-css')
    <link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
        <div class="card card-nav-tabs">
            <div class="card-header card-header-primary">
                {{ $appointment->patient->name }}
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">{{ $appointment->date }}</li>
                <li class="list-group-item">{{ $appointment->time }}</li>
                <li class="list-group-item">{{ $appointment->amount }}</li>
                <li class="list-group-item">{{ $appointment->note }}</li>
            </ul>
        </div>
        </div>
    </div>
@endsection
