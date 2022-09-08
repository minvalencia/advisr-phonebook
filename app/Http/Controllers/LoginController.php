<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('auth.login');
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
        $success = true;
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            $user = User::where('email', '=', $request->email)->first();
            $request->session()->put('name', $user->name);
            $success = true;
            return response()->json(['success' => $success, 'message' => 'Welcome', 'url' => '/contact']);
        } else {
            $success = false;
            return response()->json(['success' => $success, 'message' => 'Authentication failed!.']);
        }
    }

    /**
     * Registration a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $success = true;
        $validate_email = User::where('email', '=', $request->email)->count();
        $validate_number = Contact::where('number', '=', $request->number)->count();
        if ($validate_email > 0) {
            $success = false;
            return response()->json(['success' => $success, 'message' => 'Email is already exist!.']);
        } else if ($validate_number > 0) {
            $success = false;
            return response()->json(['success' => $success, 'message' => 'Number is already exist!.']);
        } else {
            $user = User::Create([
                'name' => $request->full_name,
                'email' => $request->email,
                'email_verified_at' => NOW(),
                'password' => bcrypt($request->password),
                'created_at' => NOW()
            ]);
            Contact::Create([
                'number' => $request->number,
                'user_id' => $user->id,
                'created_at' => NOW()
            ]);
            $request->session()->put('name', $user->name);
            $success = true;
            return response()->json(['success' => $success, 'message' => 'Welcome', 'url' => '/']);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
