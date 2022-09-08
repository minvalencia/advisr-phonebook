@extends('layouts.home')

@section('content')
    <div class="row w-100 m-0">
        <div class="content-wrapper full-page-wrapper d-flex align-items-center auth login-bg">
            <div class="card col-lg-4 mx-auto">
                <div class="card-body px-5 py-5">
                    <h3 CLASS="text-center mb-3">PHONE<span class="card-title text-center mb-3">BOOK</span></h3>
                    <form id="main-form" action="{{ route('phonebook.home.login') }}">
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="text" class="form-control p_input required" id="email" name="email">
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
                            <button id="login" type="button" class="btn btn-primary btn-block enter-btn">Login</button>
                        </div>
                        <div class="text-center">
                            <a href="{{ url('/register') }}">Register</a>
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

            $('#login').click(function() {
                if (checkValidation()) {
                    $('#login').text('Processing ..').prop("disabled", true);
                    var form_data = new FormData()
                    form_data.append('email', email.val());
                    form_data.append('password', password.val());
                    $.ajax({
                        data: form_data,
                        url: form.attr('action'),
                        type: "POST",
                        contentType: false, // The content type used when sending data to the server.
                        cache: false, // To unable request pages to be cached
                        processData: false,
                        success: function(data) {
                            if (data.success) {
                                $('#login').text('Submit').prop("disabled", false);
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
                            $('#login').text('Submit').prop("disabled", false);
                        },
                        error: function(data) {
                            console.log('Error:', data);
                            $.each(data.responseJSON.errors, function(key, value) {
                                //toastr.error(value);
                                console.log(value);
                                $('#login').text('Submit').prop("disabled",
                                    false);
                            });
                        }
                    });
                }
            });

            function checkValidation() {
                removeValidation();
                isValid = true;

                if (password.val() == '') {
                    isValid = false;
                    $("#password").addClass('is-invalid');
                    $('#password ~ .invalid-feedback').text('Please fill out the Password.');
                }
                if (email.val() == '') {
                    isValid = false;
                    $('#email ~ .invalid-feedback').text('Please fill out the employee code.');
                    $("#email").addClass('is-invalid');
                }

                return isValid;
            }

            function removeValidation() {
                $('#email, #password').removeClass('is-invalid');
            }
        });
    </script>
@endpush
