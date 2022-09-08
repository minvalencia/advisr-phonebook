<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(REquest $request)
    {
        $user = User::where('id', '=', auth()->user()->id)->first();
        $user_contacts = $user->contacts()->paginate(10);
        $user_name = [];
        foreach ($user_contacts as $key => $user_contact) {
            $result = Contact::find($user_contact->pivot->contact_id)->user()->get();
            $user_name[] = $result[0]->name;
        }
        if ($request->ajax()) {
            $view = view('phonebook.contact.contact-data', compact('user_contacts', 'user_name'))->render();
            return response()->json(['html' => $view]);
        }
        return view('phonebook.contact.index', compact('user_contacts', 'user_name'));
    }

    /**
     * Search for specific data.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        if ($request->ajax()) {
            $contacts = Contact::where('number', 'LIKE', '%' . $request->search . '%')
                ->where('user_id', '<>', auth()->user()->id)->get();
            if (count($contacts) > 0) {
                foreach ($contacts as $contact) {
                    $data[] = [
                        'contact_id' => $contact->id,
                        'contact' => $contact->number,
                        'name' => $contact->user->name
                    ];
                }
                return response()->json([
                    'success' => true,
                    'message' => 'Results found',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'No results found'
                ]);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            $check = DB::table('contact_users')
                ->where('contact_id', '=', $request->contact_id)
                ->where('user_id', '=', auth()->user()->id)->count();
            if ($check == 0) {
                $contact = Contact::where('id', '=', $request->contact_id)->first();
                $contact->users()->attach(auth()->user());
                return response()->json([
                    'success' => true,
                    'message' => 'Contact number has been added.'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'This number is already in your contact list.'
                ]);
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = [
            'nickname' => $request->nickname
        ];
        $contact_user = DB::table('contact_users')
            ->where('id', '=', $id)
            ->update($data);
        if ($contact_user > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Contact has been updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = DB::table('contact_users')
            ->where('id', '=', $id)->delete();
        if ($result > 0) {
            return response()->json([
                'success' => true,
                'message' => 'Contact has been updated.'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong.'
            ]);
        }
    }
}
