<ul class="nav nav-pills flex-column flex-md-row mb-4">
    <li class="nav-item ">
        <a class="nav-link @if (request()->routeIs('admin.settings.general')) active @endif"
            href="{{ route('admin.settings.general') }}"><i class="ti-xs ti ti-users me-1"></i>
            General Setting</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link @if (request()->routeIs('admin.settings.socialMedia')) active @endif"
            href="{{ route('admin.settings.socialMedia') }}"><i class="ti-xs ti ti-link me-1"></i>
            Social Media</a>
    </li>
    <li class="nav-item ">
        <a class="nav-link @if (request()->routeIs('admin.settings.mail')) active @endif" href="{{ route('admin.settings.mail') }}"><i
                class="ti-xs ti ti-link me-1"></i>
            Mail Setting</a>
    </li>
</ul>
