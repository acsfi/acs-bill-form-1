
@extends('layouts.app')

@section('content')

@if (Auth::user()->id == 1 or Auth::user()->hasRole('admin'))
<div class="container">

    @include('users.navigation')

    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">
            <h1 class="card-header bg-white">{{ __('Create user') }}</h1>
            
            <div class="card-body">
                <form method="POST" action="{{route('users.store')}}">
                    @csrf   

                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email" required class="form-control" id="email" placeholder="name@example.com">
                    </div>

                    <div class="form-group">
                        <label for="name">Fullname</label>
                        <input type="text" name="name" required class="form-control" id="name" placeholder="Full name">
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" required class="form-control" id="password" placeholder="Password">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            </div>


        </div>
    </div>

</div>
@else

    Restricted access

@endif

@endsection
