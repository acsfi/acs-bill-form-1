@extends('layouts.app')




@section('content')
<div class="container">


    @include('users.navigation')


    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">

                <div class="card-body">

                    <a href="{{route('permissions.create')}}" class="btn btn-primary">Add permission</a>

                </div>

                <div class="container-fluid">
                    @foreach ($permissions as $permission)
                        <div class="row py-2 border-top">
                            <div class="col-md-4">
                                <b-icon icon="shield-lock" ></b-icon> <strong>{{ $permission->display_name }}</strong>
                            </div>
                            <div class="col-md-8">
                                <span class="badge badge-secondary">{{ $permission->name }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>


            {{ $permissions->links() }}
        </div>
    </div>

</div>
@endsection
