   <!-- Menu -->

   <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
       <div class="app-brand demo">
           <a href="{{ route('admin.home') }}" class="app-brand-link">
               <span class="app-brand-logo demo">
                   <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                       <path fill-rule="evenodd" clip-rule="evenodd"
                           d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                           fill="#7367F0" />
                       <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                           d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                       <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                           d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                       <path fill-rule="evenodd" clip-rule="evenodd"
                           d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                           fill="#7367F0" />
                   </svg>
               </span>
               <span class="app-brand-text demo menu-text fw-bold">TDS</span>
           </a>

           <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
               <i class="ti menu-toggle-icon d-none d-xl-block ti-sm align-middle"></i>
               <i class="ti ti-x d-block d-xl-none ti-sm align-middle"></i>
           </a>
       </div>

       <div class="menu-inner-shadow"></div>

       <ul class="menu-inner py-1">
           <!-- Dashboards -->
           <li class="menu-item @if (request()->routeIs('admin.home')) active open @endif">
               <a href="{{ route('admin.home') }}" class="menu-link">
                   <i class="menu-icon tf-icons ti ti-smart-home"></i>
                   <div data-i18n="Dashboards">Dashboards</div>
                   <div class="badge bg-label-primary rounded-pill ms-auto">3</div>
               </a>
           </li>

           <!-- Apps & Pages -->
           <li class="menu-header small text-uppercase">
               <span class="menu-header-text">User Management</span>
           </li>
           {{-- user menu --}}
           @can('index-user')
               <li class="menu-item @if (request()->routeIs('admin.users.index', 'admin.user.profile', 'admin.user.password')) active open @endif">
                   <a href="javascript:void(0);" class="menu-link menu-toggle">
                       <i class="menu-icon tf-icons ti ti-users"></i>
                       <div data-i18n="Users">Users</div>
                   </a>
                   <ul class="menu-sub">
                       <li class="menu-item @if (request()->routeIs('admin.users.index')) active @endif">
                           <a href="{{ route('admin.users.index') }}" class="menu-link">
                               <div data-i18n="List">List</div>
                           </a>
                       </li>
                       <li class="menu-item @if (request()->routeIs('admin.user.profile', 'admin.user.password')) active open @endif">
                           <a href="javascript:void(0);" class="menu-link menu-toggle">
                               <div data-i18n="View">View</div>
                           </a>
                           <ul class="menu-sub">
                               <li class="menu-item @if (request()->routeIs('admin.user.profile')) active @endif">
                                   <a href="{{ route('admin.user.profile') }}" class="menu-link">
                                       <div data-i18n="Account">Profile</div>
                                   </a>
                               </li>
                               <li class="menu-item @if (request()->routeIs('admin.user.password')) active @endif">
                                   <a href="{{ route('admin.user.password') }}" class="menu-link">
                                       <div data-i18n="Security">Security</div>
                                   </a>
                               </li>
                               <li class="menu-item">
                                   <a href="#" class="menu-link">
                                       <div data-i18n="Billing & Plans">Billing & Plans</div>
                                   </a>
                               </li>
                               <li class="menu-item">
                                   <a href="#" class="menu-link">
                                       <div data-i18n="Notifications">Notifications</div>
                                   </a>
                               </li>
                           </ul>
                       </li>
                   </ul>
               </li>
           @endcan
           <!-- Apps & Pages -->
           <li class="menu-header small text-uppercase">
               <span class="menu-header-text">System Setting</span>
           </li>
           {{-- Module menu --}}
           @can('index-module')
               <li class="menu-item @if (request()->routeIs('admin.module.index')) active open @endif">
                   <a href="javascript:void(0);" class="menu-link menu-toggle">
                       <i class="menu-icon tf-icons ti ti-shield-lock"></i>
                       <div data-i18n="Wizard Examples">Module Setting</div>
                   </a>
                   <ul class="menu-sub">
                       <li class="menu-item @if (request()->routeIs('admin.module.index')) active @endif">
                           <a href="{{ route('admin.module.index') }}" class="menu-link">
                               <div data-i18n="Checkout">Module List</div>
                           </a>
                       </li>
                   </ul>
               </li>
           @endcan
           {{-- permission menu --}}
           @can('index-permission')
               <li class="menu-item @if (request()->routeIs('admin.permission.index')) active open @endif">
                   <a href="javascript:void(0);" class="menu-link menu-toggle">
                       <i class="menu-icon tf-icons ti ti-fingerprint"></i>
                       <div data-i18n="Roles & Permissions">Permissions</div>
                   </a>
                   <ul class="menu-sub">
                       <li class="menu-item @if (request()->routeIs('admin.permission.index')) active @endif">
                           <a href="{{ route('admin.permission.index') }}" class="menu-link">
                               <div data-i18n="Permission">Permission</div>
                           </a>
                       </li>
                   </ul>
               </li>
           @endcan
           {{-- role menu --}}
           @can('index-role')
               <li class="menu-item @if (request()->routeIs('admin.role.index')) active open @endif">
                   <a href="javascript:void(0);" class="menu-link menu-toggle">
                       <i class="menu-icon tf-icons ti ti-lock-access"></i>
                       <div data-i18n="Roles & Permissions">Roles</div>
                   </a>
                   <ul class="menu-sub ">
                       <li class="menu-item @if (request()->routeIs('admin.role.index')) active @endif">
                           <a href="{{ route('admin.role.index') }}" class="menu-link">
                               <div data-i18n="Roles">Roles</div>
                           </a>
                       </li>
                   </ul>
               </li>
           @endcan

           <!-- Setting & Pages -->
           <li class="menu-header small text-uppercase">
               <span class="menu-header-text">System Setting</span>
           </li>
           {{-- Module menu --}}
           @can('general-setting')
               <li class="menu-item @if (request()->routeIs('admin.settings.general', 'admin.backup.index')) active open @endif">
                   <a href="javascript:void(0);" class="menu-link menu-toggle">
                       <i class="menu-icon tf-icons ti ti-tool"></i>
                       <div data-i18n="Wizard Examples">Buniness Setup </div>
                   </a>
                   <ul class="menu-sub">
                       <li class="menu-item @if (request()->routeIs('admin.settings.general')) active @endif">
                           <a href="{{ route('admin.settings.general') }}" class="menu-link">
                               <div data-i18n="Checkout">General Setup</div>
                           </a>
                       </li>
                   </ul>
                   <ul class="menu-sub">
                       <li class="menu-item @if (request()->routeIs('admin.backup.index')) active @endif">
                           <a href="{{ route('admin.backup.index') }}" class="menu-link">
                               <div data-i18n="Checkout">Database Backup</div>
                           </a>
                       </li>
                   </ul>
               </li>
               <li class="menu-item @if (request()->routeIs('admin.settings.socialite')) active open @endif">
                   <a href="{{ route('admin.settings.socialite') }}" class="menu-link">
                       <i class="menu-icon tf-icons ti ti-cloud-data-connection"></i>
                       <div data-i18n="Dashboards">3rd Party</div>
                   </a>
               </li>
           @endcan

       </ul>
   </aside>
   <!-- / Menu -->
