@extends('layouts.master')
@section('custom-css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/jquery.datetimepicker.css') }}">
    <script src="{{ asset('css/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.datetimepicker.full.js') }}"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title ">La liste des rendez-vous</h4>
                    <p class="card-category"> <button type="button" class="btn btn-info pull-right" data-toggle="modal" data-target=".bd-example-modal-lg">Ajouter un rendez-vous</button> </p>
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
                            <th>N°</th>
                            <th>Patient</th>
                            <th>Date</th>
                            <th>Temps</th>
                            <th>Note</th>
                            <th>Action</th>
                            </thead>
                            <tbody>
                            @foreach($appointments as $appointment)
                                <tr>
                                    <td>{{ $appointment->id }}</td>
                                    <td>{{ $appointment->patient->name }}</td>
                                    <td>{{ $appointment->date }}</td>
                                    <td>{{ $appointment->time }}</td>
                                    <td>{{ $appointment->note }}</td>
                                    <td>
                                        <a href="{{ route('appointment.show', $appointment->id) }}"><i class="material-icons" style="color: green" rel="tooltip" title="Voir">visibility</i></a>
                                        <a href=""><i class="material-icons" style="color: blue" rel="tooltip" title="Modifier">edit</i></a>
                                        <a onclick="return confirm('Êtes-vous sûr?')" href=""><i class="material-icons" style="color: red" rel="tooltip" title="Supprimer">delete</i></a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header card-header-primary">
                                    <h4 class="card-title">Ajouter Rendez-vous</h4>
                                </div>
                                <div class="card-body">
                                    <form method="POST" enctype="multipart/form-data" action="{{ route('add.appointment') }}">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <select name="patient_id" class="form-control" required>
                                                        <option value="" selected>Sélectionner un patient</option>
                                                        @foreach($patients as $patient)
                                                            <option value="{{ $patient->id }}">{{ $patient->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">La date</label>
                                                    <input type="date" name="date" class="form-control" id="date" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Le temps </label>
                                                    <input type="time" name="time" class="form-control" id="time" value=""/>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label-control">Le montant </label>
                                                    <input type="text" name="amount" class="form-control" id="amount" value=""/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="bmd-label-floating">Note</label>
                                                    <textarea class="form-control" name="note" id="note" cols="30" rows="10"></textarea>
                                                </div>
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
@endsection
@section('custom-js')
    <script>
        $('#datetimepicker').datetimepicker();
    </script>
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
