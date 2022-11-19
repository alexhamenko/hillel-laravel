<div class="dropdown d-flex align-items-center me-3">
    <div class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" data-bs-toggle="dropdown"
         aria-expanded="false">
        <strong>{{ Auth::user()->name }}</strong>
        <div class="placeholder bg-primary rounded-circle mx-2 d-flex align-items-center justify-content-center"
             style="width: 32px; height: 32px;opacity: .8;">
            <i class="bi bi-person" style="font-size: 1.5rem; color: white;"></i>
        </div>
    </div>
    <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
        @if(! request()->routeIs('admin.*'))
            <li><a class="dropdown-item" href="{{ route('admin.panel') }}">Admin panel</a></li>
        @endif
        <li><a class="dropdown-item" href="{{ route('admin.user.show', ['id' => Auth::user()->id]) }}">Profile</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item" href="{{ route('auth.logout') }}">Sign out</a></li>
    </ul>
</div>
