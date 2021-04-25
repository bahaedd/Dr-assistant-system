@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Changer le mot de passe</h4>
        </div>
        <div class="card-body">
          <form method="POST" action="{{ route('change.password') }}">
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
            @if (\Session::has('message'))
            <div class="alert alert-success">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <i class="material-icons">close</i>
              </button>
              <span>
                {!! \Session::get('message') !!}
              </span>
            </div>
            @endif
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Mot de passe</label>
                  <input type="password" class="form-control" name="current_password">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Nouveau Mot de passe</label>
                  <input type="password" class="form-control" name="new_password">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label class="bmd-label-floating">Confirmer mot de passe</label>
                  <input type="password" class="form-control" name="new_confirm_password">
                </div>
              </div>
            </div>
            <button type="submit" class="btn btn-info pull-right">Modifier</button>
            <div class="clearfix"></div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection