@extends('layouts.app')




@section('content')
<div class="container">


    @include('users.navigation')


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">


                <div class="card-body">

                    <a href="{{route('roles.create')}}" class="btn btn-primary">Add role</a>

                </div>
                <div class="container-fluid">
                    @foreach ($roles as $role)
                        <div class="row py-2 border-top">
                            <div class="col-md-3">
                                <strong class="m-0">{{ $role->display_name }}</strong> <br />
                                <span class="badge badge-light"><b-icon icon="shield"></b-icon> {{ $role->name }}</span>
                            </div>
                            <div class="col-md-9">
                                <role-permission v-bind:values="@json($role->permissions()->allRelatedIds())" :options="{{$permissions}}" :lock='{{ $role->id == 1 ? "true" : "false" }}' role_id='{{ $role->id }}'></role-permission>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>


            {{ $roles->links() }}
        </div>
    </div>

</div>
@endsection
