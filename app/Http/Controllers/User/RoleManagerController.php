<?php

namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Role;
use App\Permission;


class RoleManagerController extends Controller
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
    public function index(Request $request)
    {

        $roles = Role::paginate(25);
        $permissions = Permission::get();
        $ps = [];
        foreach($permissions as $p){
            $ps[] = ['value' => $p->id,'text' => $p->display_name];
        }
        return view('roles.list', [ 'roles' => $roles ,'permissions'=>json_encode($ps)]);
    }

    /**
     * User create form.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function create(Request $request,$type='user')
    {
        return view('roles.create'); 
    }
    /**
     * User store.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $role = Role::firstOrCreate([
            'name'          => $request->input('name') ,
            'display_name'  => $request->input('display') ,
            'description'   => $request->input('description') ,
        ]);
        return redirect()->route('roles', ['created' => $role ]);

    }


     /**
     * User roles manager page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function roles(Request $request)
    {

        $roles = Role::paginate(25);

        return view('users.roles', [ 'roles' => $roles ]);
    }

     /**
     * Permissions manager page.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function permissions(Request $request)
    {

        $permissions = Permission::paginate(25);

        return view('users.permissions', [ 'permissions' => $permissions ]);
    }
}
