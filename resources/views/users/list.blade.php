@extends('layouts.app')

@section('content')

@if (Auth::user()->id == 1 or Auth::user()->hasRole('admin'))
<div class="container">

    @include('users.navigation')

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <div class="card-body ">
                    <a href="{{route('users',['view'=>'create'])}}" class="btn btn-primary">Add user</a>
                </div>

                <div class="container-fluid">
                    @foreach ($users as $user)
                        <div class="row py-2 border-top">
                            <div class="col-md-6">
                                <img class="rounded-circle mr-3" align="left" src="{{ $user->getPhoto() }}" />
                                <strong>{{ $user->name }}</strong>
                                <br />

                                {{ $user->email }}
                            </div>

                            <div class="col-md-4">
                                @foreach ($user->roles as $role)
                                    <span class="badge badge-secondary"
                                    v-b-tooltip.hover  v-b-tooltip no-fade="true" title="{{ $role->display_name }}"><b-icon icon="shield"></b-icon> {{ $role->name }}</span>
                                @endforeach
                            </div>
                            <div class="col-md-2">
                                <b-link class="btn btn-outline-primary btn-block" href="{{route('users.edit',['id'=>$user->id])}}">Edit</b-link>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="card-footer pb-0">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@else

    Restricted access

@endif

@endsection
