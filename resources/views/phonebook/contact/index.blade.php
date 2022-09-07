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
                                    <div class="icon icon-box-danger float-right">
                                        <span class="mdi mdi-delete icon-item"></span>
                                    </div>
                                    <div class="icon icon-box-success float-right mr-2">
                                        <span class="mdi mdi-lead-pencil icon-item"></span>

                                    </div>
                                </div>
                            </div>
                        @endforeach
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
        <script src="{{ url('assets/modules/js/employee.js') }}"></script>
    @endpush
