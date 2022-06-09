<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            @auth
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard.home') }}" class="nav-link">
                        {{ __('admin.navbar.dashboard') }}
                    </a>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownAccountMenu"
                       class="nav-link dropdown-toggle"
                       href="#" role="button"
                       data-bs-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        {{ __('admin.navbar.account.submenu') }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownAccountMenu">
                        <a class="dropdown-item" href="{{ route('admin.accounts.admin.list') }}">
                            {{ __('admin.navbar.account.admin') }}
                        </a>
                    </div>
                </li>

                <li class="nav-item dropdown">
                    <a id="dropdownContentMenu"
                       class="nav-link dropdown-toggle"
                       href="#" role="button"
                       data-bs-toggle="dropdown"
                       aria-haspopup="true"
                       aria-expanded="false">
                        {{ __('admin.navbar.content.submenu') }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownContentMenu">
                        <a class="dropdown-item" href="{{ route('admin.contents.offer.list') }}">
                            {{ __('admin.navbar.content.offer') }}
                        </a>
                    </div>
                </li>
            </ul>
            @endauth

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ms-auto">
                <!-- Authentication Links -->
                @guest
                @if (Route::has('admin.accounts.user.login'))
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.accounts.user.login') }}">{{ __('Login') }}</a>
                </li>
                @endif

                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        {{ Auth::user()->login() }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('admin.accounts.user.logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('admin.accounts.user.logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
