
@extends('layouts.app')

@section('content')

@if (Auth::user()->id == 1 or Auth::user()->hasRole('admin'))
<div class="container">

    @include('users.navigation')

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <h2 class="card-header bg-white">{{$user->name}}</h2>

                <div class="card-body">

                    <div class="row">

                        <div class="col-md-9">

                            <form method="POST" action="{{route('users.update',['id'=>$user->id])}}">
                                @csrf

                                <div class="form-group">
                                    <label for="email">Email address</label>
                                    <input type="email" name="email" required class="form-control" id="email" value="{{$user->email}}" placeholder="{{$user->email}}">
                                </div>

                                <div class="form-group">
                                    <label for="name">Fullname</label>
                                    <input type="text" name="name" required class="form-control" id="name" value="{{$user->name}}" placeholder="Full name">
                                </div>

                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                                </div>

                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-3">
                            <upload-image action="{{route('users.upload',['id'=>$user->id])}}"></upload-image>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@else

    Restricted access

@endif

@endsection
