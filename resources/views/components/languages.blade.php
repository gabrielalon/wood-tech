<ul class="navbar-nav ms-auto">
    <li class="nav-item dropdown">
        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ __('general.languages') }}
        </a>

        <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
            @foreach($languages as $language)
                <a class="dropdown-item" href="{{ route('web.contents.home', ['locale' => $language->code]) }}">
                    {{ $language->nativeName }}
                </a>
            @endforeach
        </div>
    </li>
</ul>
