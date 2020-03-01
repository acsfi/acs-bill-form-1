
<ul class="nav nav-pills">
    <li class="nav-item">
        <a class="nav-link {{ in_array(request()->route()->getName() ,['users']) ? 'active' : '' }}" href="{{route('users')}}"> 
            <b-icon icon="people"></b-icon> {{ __('Users') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{in_array(request()->route()->getName() ,['roles']) ? 'active' : '' }}" href="{{route('roles')}}">  
            <b-icon icon="shield"></b-icon>   {{ __('Roles') }}
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{in_array(request()->route()->getName() ,['permissions']) ? 'active' : '' }}" href="{{route('permissions')}}"> 
            <b-icon icon="shield-lock"></b-icon> {{ __('Permissions') }}
        </a>
    </li>
</ul>