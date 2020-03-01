@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                       
                        @if (Auth::user()->id == 1)
                                <a href="{{route('users')}}" class="btn btn-secondary">
                                    Users
                                </a>
                        @endif
                    
                    @endif

                    <passport-clients></passport-clients>
                    <passport-authorized-clients></passport-authorized-clients>
                    <passport-personal-access-tokens></passport-personal-access-tokens>


                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
