@extends('layouts.home')

@section('content')
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
                <div class="card-body px-5 py-5">
                    <h3 CLASS="text-center mb-3">PHONE<span class="card-title text-center mb-3">BOOK</span></h3>
                    <form id="main-form" action="{{ route('phonebook.home.register') }}">
                        <div class="form-group">
                            <label>Full Name*</label>
                            <input type="text" class="form-control p_input required" id="full_name" name="full_name">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="text" class="form-control p_input required" id="email" name="email">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Number *</label>
                            <input type="text" class="form-control p_input required" id="number" name="number">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Password *</label>
                            <input type="password" class="form-control p_input required" id="password" name="password">
                            <div class="invalid-feedback">
                                Please choose a username.
                            </div>
                        </div>
                        <div class="text-center">
                            <button id="register" type="button"
                                class="btn btn-primary btn-block enter-btn">Register</button>
                        </div>
                        <div class="text-center">
                            <a href="{{ url('/') }}">Back to Login</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('styles')
@endpush
@push('scripts')
    <script>
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).prop('title', 'Login | Phonebook');
            let isValid = true;
            let form = $("#main-form");
            let email = $("#email");
            let password = $("#password");
            let full_name = $("#full_name");
            let number = $("#number");

            $('#number').keypress(function(e) {
                keyNumber(e);
            });

            $('#full_name').keypress(function(e) {
                keyStringName(e);
            });

            $('#email').keypress(function(e) {
                keyStringEmailAddress(e);
            });

            $('#register').click(function() {
                if (checkValidation()) {
                    $('#register').text('Processing ..').prop("disabled", true);
                    var form_data = new FormData()
                    form_data.append('email', email.val());
                    form_data.append('password', password.val());
                    form_data.append('full_name', full_name.val());
                    form_data.append('number', number.val());
                    $.ajax({
                        data: form_data,
                        url: form.attr('action'),
                        type: "POST",
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        success: function(data) {
                            if (data.success) {
                                $('#register').text('Submit').prop("disabled", false);
                                var origin = window.location.origin;
                                window.location.href = origin + data.url;
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
                            $('#register').text('Submit').prop("disabled", false);
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $.each(data.responseJSON.errors, function(key, value) {
                                //toastr.error(value);
                                console.log(value);
                                $('#register').text('Submit').prop("disabled",
                                    false);
                            });
                        }
                    });
                }
            });

            function checkValidation() {
                removeValidation();
                isValid = true;
                if (full_name.val() == '') {
                    isValid = false;
                    $("#full_name").addClass('is-invalid');
                    $('#full_name ~ .invalid-feedback').text('Please fill out the full name.');
                }
                if (password.val() == '') {
                    isValid = false;
                    $("#password").addClass('is-invalid');
                    $('#password ~ .invalid-feedback').text('Please fill out the Password.');
                } else {
                    pass = password.val();
                    if (pass.length < 8) {
                        isValid = false;
                        $("#password").addClass('is-invalid');
                        $('#password ~ .invalid-feedback').text('Please enter 8 minimum characters.');
                    }
                }
                if (email.val() == '') {
                    isValid = false;
                    $('#email ~ .invalid-feedback').text('Please fill out the employee code.');
                    $("#email").addClass('is-invalid');
                }
                if (number.val() == '') {
                    isValid = false;
                    $("#number").addClass('is-invalid');
                    $('#number ~ .invalid-feedback').text('Please fill out the number.');
                } else {
                    phone = number.val();
                    if (phone.length == 10 || phone.length == 11) {

                    } else {
                        isValid = false;
                        $("#number").addClass('is-invalid');
                        $('#number ~ .invalid-feedback').text('Please enter valid number');
                    }
                }

                return isValid;
            }

            function removeValidation() {
                $('#email, #password, #full_name, #number').removeClass('is-invalid');
            }

            function keyStringEmailAddress(e) {
                keyValue = String.fromCharCode(e.charCode || e.keyCode);
                allowedValue = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789._-@';
                if (e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    if (!allowedValue.includes(keyValue)) {
                        e.preventDefault();
                    }
                }
            }

            function keyStringName(e) {
                keyValue = String.fromCharCode(e.charCode || e.keyCode);
                allowedValue = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ ';
                if (e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    if (!allowedValue.includes(keyValue)) {
                        e.preventDefault();
                    }
                }
            }

            function keyNumber(e) {
                keyValue = String.fromCharCode(e.charCode || e.keyCode);
                allowedValue = '0123456789';
                if (e.ctrlKey || e.altKey) {
                    e.preventDefault();
                } else {
                    if (!allowedValue.includes(keyValue)) {
                        e.preventDefault();
                    }
                }
            }
        });
    </script>
@endpush
