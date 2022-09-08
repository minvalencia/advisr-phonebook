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
                        <input type="text" class="form-control" placeholder="look up a number, then choose to add ..."
                            id="search">
                        <ul id="searchResult"></ul>
                        <div class="clear"></div>
                        <div id="userDetail"></div>
                        <div id="div_contact">
                            @include('phonebook.contact.contact-data')
                        </div>
                        <div class="load-data text-center" style="display:none">
                            <i class="mdi mdi-48px mdi-spin mdi-loading"></i> Loading ...
                        </div>
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
        <style>
            .clear {
                clear: both;
                margin-top: 20px;
            }

            #searchResult {
                list-style: none;
                padding: 0px;
                width: 100%;
                position: absolute;
                margin: 0;
            }

            #searchResult li {
                background: #8d8787;
                color: black;
                padding: 4px;
                margin-bottom: 1px;
            }

            #searchResult li:nth-child(even) {
                background: #D3D3D3;
                color: black;
            }

            #searchResult li:hover {
                cursor: pointer;
            }
        </style>
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
                                                text: data.message,
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

            $("#search").keyup(function() {
                var search = $(this).val();

                if (search != "") {
                    var form_data = new FormData()
                    form_data.append('search', search);
                    $.ajax({
                        data: form_data,
                        url: "{{ route('phonebook.admin.contact.search') }}",
                        type: "POST",
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        success: function(response) {
                            $("#searchResult").empty();
                            if (response.success) {
                                for (var i = 0; i < response.data.length; i++) {
                                    var contact_id = response.data[i]['contact_id'];
                                    var contact = response.data[i]['contact'];
                                    var name = response.data[i]['name'];
                                    $("#searchResult").append("<li value='" + contact_id + "'>" + name +
                                        " - " + contact + "</li>");
                                }
                                // binding click event to li
                                $("#searchResult li").bind("click", function() {
                                    addContact(this);
                                });
                            } else {
                                $("#searchResult").append("<li>No matches found</li>");
                            }
                        }
                    });
                } else {
                    $("#searchResult").empty();
                }

            });

            // Set Text to search box and add contact
            function addContact(element) {
                var contact_id = $(element).val();
                var form_data = new FormData()
                form_data.append('contact_id', contact_id);
                $.ajax({
                    data: form_data,
                    url: "{{ route('phonebook.admin.contact.store') }}",
                    type: "POST",
                    contentType: false, // The content type used when sending data to the server.
                    cache: false, // To unable request pages to be cached
                    processData: false,
                    success: function(response) {
                        if (response.success) {
                            swal({
                                title: "Success!",
                                text: response.message,
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
                                text: response.message,
                                icon: "error",
                                buttons: false,
                                timer: 3000
                            });
                            console.log('Something went wrong.');
                        }
                    }
                });
            }

            function loadMoreData(page) {
                $.ajax({
                        url: '?page=' + page,
                        type: 'get',
                        beforeSend: function() {
                            $(".load-data").show();
                        }
                    })
                    .done(function(data) {
                        if (data.html == "") {
                            $('.load-data').html("No more contacts Found!");
                            return;
                        }
                        $('.load-data').hide();
                        $("#div_contact").append(data.html);
                    })
                    // Call back function
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        console.log("Server not responding.....");
                    });

            }
            //function for Scroll Event
            var page = 1;
            $(window).scroll(function() {
                let val = $(window).scrollTop() + $(window).height();
                let rnd = Math.round(val);

                if (rnd >= $(document).height()) {
                    page++;
                    if ({!! $user_contacts->lastPage() !!} == page) {
                        loadMoreData(page);
                    }
                }
            });
        </script>
    @endpush
