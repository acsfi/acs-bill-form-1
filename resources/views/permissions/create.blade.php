@extends('layouts.app')




@section('content')
<div class="container">

   
    @include('users.navigation')
    
    
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card shadow border-0">
                <h1 class="card-header bg-white">{{ __('Create permission') }}</h1>

                <div class="card-body">

                    <form method="POST" action="{{route('permissions.store')}}">
                        @csrf   

                        <div class="form-group">
                            <label for="name">Name</label>
                            <select name="name" class="form-control">
                                @foreach($definedPermissions as $permission)
                                    <option value="{{$permission}}">{{$permission}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="name">Display name</label>
                            <input type="text" name="display" required class="form-control" id="display" placeholder="Display title">
                        </div>
                        <div class="form-group">
                            <label for="desc">Description</label>
                            <textarea name="description" class="form-control" id="desc" placeholder="Description "></textarea>
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
@endsection
