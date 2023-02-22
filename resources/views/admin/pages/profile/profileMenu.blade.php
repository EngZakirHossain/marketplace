<ul class="nav nav-pills flex-column flex-md-row mb-4">
    <li class="nav-item ">
        <a class="nav-link @if (request()->routeIs('admin.user.profile')) active @endif" href="{{ route('admin.user.profile') }}"><i
                class="ti-xs ti ti-users me-1"></i>
            Account</a>
    </li>
    <li class="nav-item">
        <a class="nav-link @if (request()->routeIs('admin.user.password')) active @endif" href="{{ route('admin.user.password') }}"><i
                class="ti-xs ti ti-lock me-1"></i> Security</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="ti-xs ti ti-file-description me-1"></i>
            Billing & Plans</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="ti-xs ti ti-bell me-1"></i>
            Notifications</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#"><i class="ti-xs ti ti-link me-1"></i>
            Connections</a>
    </li>
</ul>
