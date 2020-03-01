<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
     * User manager page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('users.edit',['user'=>$user]);

    }

    /**
     * User store.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request,$id)
    {
        $user = User::find($id);
        $user->name  = $request->input('name');
        $user->email = $request->input('email');

        if($request->input('password')){
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();

        return redirect()->route('users', ['created' => $user ]);

    }

    public function upload(Request $request){

    }


}
