<header>
    <nav>
        <ul class="menu">
            <li class="logo">
                <a href="#">
                    LOGO
                </a>
            </li>
            <ul>
                @auth()
                    <li><a href="{{ route('auth.logout') }}">Log out</a></li>
                @else
                    <li><a href="{{ route('auth.login') }}">Sign in</a></li>
                @endauth
            </ul>
        </ul>
    </nav>
</header>