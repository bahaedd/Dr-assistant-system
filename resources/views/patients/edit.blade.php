@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Editer les informations de {{ $patient->name }}</h4>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data" action="{{ route('patient.update', $patient->id) }}">
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
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Nom Complet</label>
                  <input type="text" class="form-control" value="{{ $patient->name }}" name="name">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Email</label>
                  <input type="email" class="form-control" value="{{ $patient->email }}" name="email">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <select name="gender" class="form-control">
                    <option value="homme" {{ $patient->gender == 'homme' ? 'selected' : '' }}>Homme</option>
                    <option value="femme" {{ $patient->gender == 'femme' ? 'selected' : '' }}>Femme</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Télephone</label>
                    <input type="text" class="form-control" name="phone" value="{{ $patient->phone }}">
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label class="bmd-label-floating">Adresse</label>
                    <input type="text" class="form-control" name="adress" value="{{ $patient->adress }}">
                  </div>
                </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Photo</label><br>
                <input type="file" name="image">
              </div>
            </div>
            <button type="submit" class="btn btn-info pull-right">Changer le profile</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="card card-profile">
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
          <h6 class="card-category text-gray">{{ $patient->name }}</h6>
          <h6 class="card-category text-gray">{{ $patient->gender }}</h6>
          <h6 class="card-category text-gray">{{ $patient->email }}</h6>
          <h6 class="card-category text-gray">{{ $patient->phone }}</h6>
          <h6 class="card-category text-gray">{{ $patient->adress }}</h6>
        </div>
      </div>
    </div>
</div>
@endsection
