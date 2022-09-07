@extends('layouts.admin')

@section('content')
    <div class="content-wrapper">
        <div class="page-header">
            <h3 class="page-title"> Welcome User to Phonebook </h3>
        </div>
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">My Contacts</h4>
                        <input type="text" class="form-control" placeholder="Search contacts">
                        @foreach ($user_contacts as $key => $user_contact)
                            <div
                                class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
                                <div class="text-md-center text-xl-left">
                                    <h6 class="mb-1">{{ $user_contact->number }}</h6>
                                    <p class="text-muted mb-0">{{ $user_contact->users[$key]->name }}
                                        @if ($user_contact->pivot->nickname)
                                            ({{ $user_contact->pivot->nickname }})
                                        @endif
                                    </p>
                                </div>
                                <div class="flex-grow py-md-2 py-xl-0 float-right">
                                    <div class="float-right">
                                        <button type="button" class="btn btn-social-icon btn-youtube delete-contact"
                                            data-pivotid="{{ $user_contact->pivot->id }}"><i
                                                class="mdi mdi-delete"></i></button>
                                    </div>
                                    <div class="float-right mr-2">
                                        <button type="button" data-name="{{ $user_contact->users[$key]->name }}"
                                            data-number="{{ $user_contact->number }}"
                                            data-nickname="{{ $user_contact->pivot->nickname }}"
                                            data-id="{{ $user_contact->pivot->id }}"
                                            class="btn btn-social-icon btn-facebook edit-contact" data-toggle="modal"
                                            data-target="#contactModal"><i class="mdi mdi-lead-pencil"></i></button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="contactModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="main-form" class="form-sample">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-sm-1 col-form-label">Nickname</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control required" id="nickname"
                                            name="nickname" />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-sm-1 col-form-label">Name</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control required" id="name" name="name"
                                            disabled />
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-sm-1 col-form-label">Number</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control required" id="number" name="number"
                                            disabled />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" id="save-contact">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('styles')
        <link rel="stylesheet" href="{{ url('/assets/vendors/select2/select2.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ url('assets/modules/css/datatable.css') }}">
        <link href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap4.min.css" rel="stylesheet">
        <link rel="stylesheet" href="{{ url('assets/scss/style.css') }}">
    @endpush
    @push('scripts')
        <!-- Plugin js for this page -->
        <script src="{{ url('assets/vendors/select2/select2.min.js') }}"></script>
        <script src="{{ url('assets/js/select2.js') }}"></script>
        <!-- End custom js for this page -->
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap4.min.js"></script>
        <script>
            $(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                let name = $('#name');
                let number = $('#number');
                let nickname = $('#nickname');
                let id = 0;
                $(".edit-contact").click(function() {
                    let dName = $(this).data("name");
                    let dNumber = $(this).data("number");
                    let dNickname = $(this).data("nickname");
                    id = $(this).data("id");
                    name.val(dName);
                    number.val(dNumber);
                    nickname.val(dNickname);
                });

                $(".delete-contact").click(function() {
                    let pivotId = $(this).data("pivotid");
                    swal({
                            title: "Are you really sure?",
                            text: "This is very dangerous, you shouldn't do it!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                var form_data = new FormData()
                                var id = $(this).data("id");
                                form_data.append('_method', 'DELETE');
                                $.ajax({
                                    data: form_data,
                                    url: '/contact/' + pivotId + '/delete',
                                    type: "POST",
                                    contentType: false, // The content type used when sending data to the server.
                                    cache: false, // To unable request pages to be cached
                                    processData: false,
                                    success: function(data) {
                                        if (data.success) {
                                            swal({
                                                title: "Success!",
                                                text: "Contact has beem deleted.",
                                                icon: "success",
                                                buttons: false,
                                                timer: 3000
                                            });
                                            setTimeout(() => {
                                                location.reload();
                                            }, 3000);
                                        } else {
                                            swal({
                                                title: "Error!",
                                                text: error_message[data.error_no],
                                                icon: "error",
                                                buttons: false,
                                                timer: 3000
                                            });
                                            console.log('Something went wrong.');
                                        }
                                    },
                                    error: function(data) {
                                        alert('Error:', data);
                                        $.each(data.responseJSON.errors, function(key, value) {
                                            swal({
                                                title: "Error!",
                                                text: value,
                                                icon: "error",
                                                buttons: false,
                                                timer: 3000
                                            });
                                            console(value);
                                        });
                                    }
                                });
                            }
                        });
                });
                $('#save-contact').click(function() {
                    $('#save-contact').text('Processing ..').prop("disabled", true);
                    var form_data = new FormData()
                    form_data.append('id', id);
                    form_data.append('nickname', nickname.val());
                    form_data.append('_method', 'PATCH');
                    $.ajax({
                        data: form_data,
                        url: '/contact/' + id + '/update',
                        type: "POST",
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        success: function(data) {
                            if (data.success) {
                                swal({
                                    title: "Success!",
                                    text: "Contact has been updated.",
                                    icon: "success",
                                    buttons: false,
                                    timer: 3000
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                                $('#save-contact').text('Submit').prop("disabled", false);
                            } else {
                                swal({
                                    title: "Error!",
                                    text: data.message,
                                    icon: "error",
                                    buttons: false,
                                    timer: 3000
                                });
                                console.log('Something went wrong.');
                            }
                            $('#save-contact').text('Submit').prop("disabled", false);
                        },
                        error: function(data) {
                            alert('Error:', data);
                            $.each(data.responseJSON.errors, function(key, value) {
                                swal({
                                    title: "Error!",
                                    text: value,
                                    icon: "error",
                                    buttons: false,
                                    timer: 3000
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 3000);
                                $('#save-contact').text('Submit').prop("disabled",
                                    false);
                            });
                        }
                    });
                });

            });
        </script>
    @endpush
