<header class="d-flex align-items-center justify-content-between pb-3 mb-5 border-bottom">
    <a href="/" class="d-flex align-items-center text-dark text-decoration-none">
        <img id="zeroplexLogo" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQGhqO6VaJK9DqglCud7kYjc3aMyabOeyEZxg&s" alt="Logo" />
        <span class="fs-4 ms-2">Task Manager</span>
    </a>
    <div class="d-flex align-items-center">
        @auth
            <div class="flex-shrink-0 dropdown">
                <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                    <span>{{Auth::user()->name}}</span>
                </a>
                <ul class="dropdown-menu text-small shadow" aria-labelledby="dropdownUser">
                    <li><a class="dropdown-item" href="{{ route('profile.edit') }}">{{ __('Profile') }}</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item">{{ __('Sign out') }}</button>
                        </form>
                    </li>
                </ul>
            </div>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">{{ __('Login') }}</a>
            <a href="{{ route('register') }}" class="btn btn-primary">{{ __('Register') }}</a>
        @endauth
    </div>
</header>