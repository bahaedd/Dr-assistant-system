@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title">Editer le profil</h4>
        </div>
        <div class="card-body">
          <form method="POST" enctype="multipart/form-data" action="{{ route('change.profile', $user->id) }}">
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
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Nom Complet</label>
                  <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label class="bmd-label-floating">Email</label>
                  <input type="email" class="form-control" value="{{ $user->email }}" name="email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Biographie</label>
                  <div class="form-group">
                    <textarea name="bio" id="bio" class="form-control" rows="4">{{ $user->bio }}</textarea>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <label>Photo de profile</label><br>
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
            @if($user->image)
              <img class="img" src="{{ asset($user->image) }}" />
            @else
              <img class="img" src="{{ asset('images/login.jpg') }}" />
            @endif
          </a>
        </div>
        <div class="card-body">
          <h6 class="card-category text-gray">{{ $user->name }}</h6>
          <p class="card-description">
            {{ $user->bio }}
          </p>
        </div>
      </div>
    </div>
</div>
@endsection