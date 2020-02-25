@extends('layouts.app')

@section('content')

@if (Auth::user()->id == 1 or Auth::user()->hasRole('admin'))
<div class="container">

    @include('users.navigation')

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <h1 class="card-header bg-white">{{ __('Create user') }}</h1>
                <div class="card-body ">
                    <a href="{{route('users.create')}}" class="btn btn-primary">Add user</a>
                </div>


                <div class="container-fluid">
                    @foreach ($users as $user)
                        <div class="row py-2 border-top">
                            <div class="col-md-1">
                                <img class="rounded" src="{{ $user->getPhoto() }}" />
                            </div>
                            <div class="col-md-4 font-weight-bold">
                                {{ $user->email }}
                            </div>

                            <div class="col-md-4">
                                {{ $user->name }}
                                @foreach ($user->roles as $role)
                                    {{ $role->name }}
                                @endforeach
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
