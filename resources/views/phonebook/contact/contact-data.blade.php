@foreach ($user_contacts as $key => $user_contact)
    <div class="bg-gray-dark d-flex d-md-block d-xl-flex flex-row py-3 px-4 px-md-3 px-xl-4 rounded mt-3">
        <div class="text-md-center text-xl-left">
            <h6 class="mb-1">{{ $user_contact->number }}</h6>
            <p class="text-muted mb-0">{{ $user_name[$key] }}
                @if ($user_contact->pivot->nickname)
                    ({{ $user_contact->pivot->nickname }})
                @endif
            </p>
        </div>
        <div class="flex-grow py-md-2 py-xl-0 float-right">
            <div class="float-right">
                <button type="button" class="btn btn-social-icon btn-youtube delete-contact"
                    data-pivotid="{{ $user_contact->pivot->id }}"><i class="mdi mdi-delete"></i></button>
            </div>
            <div class="float-right mr-2">
                <button type="button" data-name="{{ $user_name[$key] }}" data-number="{{ $user_contact->number }}"
                    data-nickname="{{ $user_contact->pivot->nickname }}" data-id="{{ $user_contact->pivot->id }}"
                    class="btn btn-social-icon btn-facebook edit-contact" data-toggle="modal"
                    data-target="#contactModal"><i class="mdi mdi-lead-pencil"></i></button>
            </div>
        </div>
    </div>
@endforeach
