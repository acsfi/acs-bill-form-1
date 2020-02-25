@extends('layouts.app')




@section('content')
<div class="container">

   
    @include('users.navigation')
    
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <h1 class="card-header bg-white">{{ __('Roles') }}</h1>

                <div class="card-body">

                    <a href="{{route('users.create',['type'=>'role'])}}" class="btn btn-primary">Add role</a>
                    @foreach ($roles as $role)
                        <div class="row">
                            <div class="col-md-8">
                                <h4>{{ $permission->name }}</h4>
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
