@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">La liste des Patients</h4>
          <p class="card-category"> <button id="myBtn" class="btn btn-info pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Ajouter Patient</button> </p>
        </div>
        <div class="card-body">
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
          <div class="table-responsive">
            <table class="table">
              <thead class="text-primary">
                <th>Photo</th>
                <th>Nom Complet</th>
                <th>Sexe</th>
                <th>Adresse</th>
                <th>Télephone</th>
                <th>Action</th>
              </thead>
              <tbody>
                    @foreach($patients as $patient)
                      <tr>
                        <td>
                            @if($patient->image)
                                <img width="40px" height="40px" src="{{ asset($patient->image) }}">
                            @else
                                <img width="40px" height="40px" src="{{ asset('/storage/uploads/p.png') }}">
                            @endif
                        </td>
                        <td>{{ $patient->name }}</td>
                        <td>{{ $patient->gender }}</td>
                        <td>{{ $patient->adress }}</td>
                        <td>{{ $patient->phone }}</td>
                        <td>
                          <a href="{{ route('patient.show', $patient->id) }}"><i class="material-icons" style="color: green" rel="tooltip" title="Voir">visibility</i></a>
                          <a href="{{ route('patient.edit', $patient->id) }}"><i class="material-icons" style="color: blue" rel="tooltip" title="Modifier">edit</i></a>
                          <a onclick="return confirm('Êtes-vous sûr?')" href="{{ route('patient.delete', $patient->id) }}"><i class="material-icons" style="color: red" rel="tooltip" title="Supprimer">delete</i></a>
                        </td>
                      </tr>
                    @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- The Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Ajouter Patient</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('add.patient') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Nom Complet</label>
                                                    <input type="text" class="form-control" name="name" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Email</label>
                                                    <input type="email" class="form-control" name="email" required>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <select name="gender" class="form-control" required>
                                                        <option value="" selected>Sexe</option>
                                                        <option value="homme">Homme</option>
                                                        <option value="femme">Femme</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Télephone</label>
                                                    <input type="text" class="form-control" name="phone" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Adresse</label>
                                                    <input type="text" class="form-control" name="adress" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label>Photo</label><br>
                                                <input type="file" name="image" accept="image/png, image/jpeg, image/jpg" required>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-info pull-right">Ajouter</button>
                                        <div class="clearfix"></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
  </div>
</div>
@endsection
@section('custom-js')
    <script>
        // Get the modal
        var modal = document.getElementById("myModal");

        // Get the button that opens the modal
        var btn = document.getElementById("myBtn");

        // Get the <span> element that closes the modal
        var span = document.getElementsByClassName("close")[0];

        // When the user clicks on the button, open the modal
        btn.onclick = function() {
        modal.style.display = "block";
        }

        // When the user clicks on <span> (x), close the modal
        span.onclick = function() {
        modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
        }
    </script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function () {
        $('#form').validate({
            rules: {
                name: {
                    required: true
                },
                email: {
                    required: true,
                    email: true
                },
                gender: {
                    required: true
                },
                phone: {
                    required: true,
                    digits: true
                },
                adress: {
                    required: true
                },
                image: {
                    required: true
                },
            },
              errorElement: 'span',
              errorPlacement: function (error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
              },
              highlight: function (element, errorClass, validClass) {
                $(element).addClass('is-invalid');
              },
              unhighlight: function (element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
              }
            });
          });
    </script>
@endsection
