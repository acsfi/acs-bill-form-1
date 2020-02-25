
<ul class="nav justify-content-center nav-pills nav-fill">
    <li class="nav-item">
        <a class="nav-link {{ in_array(request()->route()->getName() ,['users','users.create']) ? 'active' : '' }}" href="{{route('users')}}"> {{ __('Users') }} </a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{in_array(request()->route()->getName() ,['roles','roles.create']) ? 'active' : '' }}" href="{{route('roles')}}">{{ __('Roles') }}</a>
    </li>
    <li class="nav-item">
        <a class="nav-link {{ url()->current() == route('users.permissions') ? 'active' : '' }}" href="{{route('users.permissions')}}">{{ __('Permissions') }}</a>
    </li>
</ul>