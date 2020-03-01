<?php

use App\Role;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->post('/role/update/{role_id}', function (Request $request,$role_id) {


    $role = Role::find($role_id);
    $role->permissions()->sync($request->post('value'));
    $role->save();
    return response()->json(['role'=>$role->permissions]);
});
