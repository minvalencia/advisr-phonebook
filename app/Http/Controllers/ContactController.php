<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::where('id', '=', 1)->first();
        $user_contacts = $user->contacts()->get();
        foreach ($user_contacts as $key => $user_contact) {
            //dd($user_contact->users);
        }
        return view('phonebook.contact.index', compact('user_contacts'));
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
        //
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
