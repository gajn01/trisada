<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding text-center">
            <a class="app-logo" href="{{ url('dashboard') }}"><img class="logo-icon me-2"
                    src="{{ asset('img/mg-logo.png') }}" alt="logo"></a>
        </div>
        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => Request::route()->named('dashboard')]) href="{{ url('dashboard') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" fill="currentColor"
                                class="bi bi-house-door" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                    d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                {{-- @if (Gate::allows('allow-view', 'module-reservation')) --}}
                <li class="nav-item">
                    <a @class(['nav-link', 'active' => Request::route()->named('toda-list')]) href="{{ route('toda-list') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                class="bi bi-kanban" viewBox="0 0 16 16">
                                <path
                                    d="M13.5 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1h-11a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h11zm-11-1a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h11a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2h-11z" />
                                <path
                                    d="M6.5 3a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm-4 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3zm8 0a1 1 0 0 1 1-1h1a1 1 0 0 1 1 1v10a1 1 0 0 1-1 1h-1a1 1 0 0 1-1-1V3z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Toda Management</span>
                    </a>
                </li>
                {{-- @endif --}}
                <li class="nav-item">
                    <a @class([
                        'nav-link',
                        'active' => Request::route()->named('terminal-list'),
                    ]) href="{{ route('terminal-list') }}">
                        <span class="nav-icon">
                            <svg xmlns="http://www.w3.org/2000/svg"class="w-5 h-5" fill="currentColor"
                                class="bi bi-car-front-fill" viewBox="0 0 16 16">
                                <path
                                    d="M2.52 3.515A2.5 2.5 0 0 1 4.82 2h6.362c1 0 1.904.596 2.298 1.515l.792 1.848c.075.175.21.319.38.404.5.25.855.715.965 1.262l.335 1.679c.033.161.049.325.049.49v.413c0 .814-.39 1.543-1 1.997V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.338c-1.292.048-2.745.088-4 .088s-2.708-.04-4-.088V13.5a.5.5 0 0 1-.5.5h-2a.5.5 0 0 1-.5-.5v-1.892c-.61-.454-1-1.183-1-1.997v-.413a2.5 2.5 0 0 1 .049-.49l.335-1.68c.11-.546.465-1.012.964-1.261a.807.807 0 0 0 .381-.404l.792-1.848ZM3 10a1 1 0 1 0 0-2 1 1 0 0 0 0 2Zm10 0a1 1 0 1 0 0-2 1 1 0 0 0 0 2ZM6 8a1 1 0 0 0 0 2h4a1 1 0 1 0 0-2H6ZM2.906 5.189a.51.51 0 0 0 .497.731c.91-.073 3.35-.17 4.597-.17 1.247 0 3.688.097 4.597.17a.51.51 0 0 0 .497-.731l-.956-1.913A.5.5 0 0 0 11.691 3H4.309a.5.5 0 0 0-.447.276L2.906 5.19Z" />
                            </svg>
                        </span>
                        <span class="nav-link-text">Terminal Management</span>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                {{-- <ul class="app-menu footer-menu list-unstyled">
                    @if (Gate::allows('allow-view', 'module-settings'))
                        <li class="nav-item has-submenu">
                            <a class="nav-link submenu-toggle collapsed" href="#" data-bs-toggle="collapse"
                                data-bs-target="#submenu-items-settings"
                                aria-expanded="{{ request()->is('settings/*') ? 'true' : 'false' }}"
                                aria-controls="submenu-settings">
                                <span class="nav-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                        fill="currentColor" class="bi bi-gear" viewBox="0 0 16 16">
                                        <path
                                            d="M8 4.754a3.246 3.246 0 1 0 0 6.492 3.246 3.246 0 0 0 0-6.492zM5.754 8a2.246 2.246 0 1 1 4.492 0 2.246 2.246 0 0 1-4.492 0z" />
                                        <path
                                            d="M9.796 1.343c-.527-1.79-3.065-1.79-3.592 0l-.094.319a.873.873 0 0 1-1.255.52l-.292-.16c-1.64-.892-3.433.902-2.54 2.541l.159.292a.873.873 0 0 1-.52 1.255l-.319.094c-1.79.527-1.79 3.065 0 3.592l.319.094a.873.873 0 0 1 .52 1.255l-.16.292c-.892 1.64.901 3.434 2.541 2.54l.292-.159a.873.873 0 0 1 1.255.52l.094.319c.527 1.79 3.065 1.79 3.592 0l.094-.319a.873.873 0 0 1 1.255-.52l.292.16c1.64.893 3.434-.902 2.54-2.541l-.159-.292a.873.873 0 0 1 .52-1.255l.319-.094c1.79-.527 1.79-3.065 0-3.592l-.319-.094a.873.873 0 0 1-.52-1.255l.16-.292c.893-1.64-.902-3.433-2.541-2.54l-.292.159a.873.873 0 0 1-1.255-.52l-.094-.319zm-2.633.283c.246-.835 1.428-.835 1.674 0l.094.319a1.873 1.873 0 0 0 2.693 1.115l.291-.16c.764-.415 1.6.42 1.184 1.185l-.159.292a1.873 1.873 0 0 0 1.116 2.692l.318.094c.835.246.835 1.428 0 1.674l-.319.094a1.873 1.873 0 0 0-1.115 2.693l.16.291c.415.764-.42 1.6-1.185 1.184l-.291-.159a1.873 1.873 0 0 0-2.693 1.116l-.094.318c-.246.835-1.428.835-1.674 0l-.094-.319a1.873 1.873 0 0 0-2.692-1.115l-.292.16c-.764.415-1.6-.42-1.184-1.185l.159-.291A1.873 1.873 0 0 0 1.945 8.93l-.319-.094c-.835-.246-.835-1.428 0-1.674l.319-.094A1.873 1.873 0 0 0 3.06 4.377l-.16-.292c-.415-.764.42-1.6 1.185-1.184l.292.159a1.873 1.873 0 0 0 2.692-1.115l.094-.319z" />
                                    </svg>
                                </span>
                                <span class="nav-link-text">Settings</span>
                                <span class="submenu-arrow">
                                    <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-chevron-down"
                                        fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                    </svg>
                                </span>
                            </a>
                            <div id="submenu-items-settings" @class([
                                'collapse submenu submenu-settings',
                                'show' => request()->is('settings/*') == true,
                            ])
                                data-bs-parent="#menu-accordion">
                                <ul class="submenu-list list-unstyled">
                                    @if (Gate::allows('allow-view', 'module-routes'))
                                        <li class="submenu-item">
                                            <a @class([
                                                'submenu-link',
                                                'active' =>
                                                    Request::route()->named('routes') ||
                                                    Request::route()->named('routes-details'),
                                            ]) href="{{ route('routes') }}"> Routes Look
                                                Up </a>
                                        </li>
                                    @endif
                                    @if (Gate::allows('allow-view', 'module-tariff'))
                                        <li class="submenu-item">
                                            <a @class([
                                                'submenu-link',
                                                'active' =>
                                                    Request::route()->named('tarif') ||
                                                    Request::route()->named('tarif-details'),
                                            ]) href="{{ route('tarif') }}"> Tariff </a>
                                        </li>
                                    @endif
                                    @if (Gate::allows('allow-view', 'module-user-management'))
                                        <li class="submenu-item">
                                            <a @class([
                                                'submenu-link',
                                                'active' =>
                                                    Request::route()->named('user-management') ||
                                                    Request::route()->named('user-details'),
                                            ]) href="{{ route('user-management') }}">User
                                                Management</a>
                                        </li>
                                    @endif
                                    @if (Gate::allows('allow-view', 'module-departments'))
                                        <li class="submenu-item">
                                            <a @class([
                                                'submenu-link',
                                                'active' =>
                                                    Request::route()->named('departments') ||
                                                    Request::route()->named('department-details'),
                                            ])
                                                href="{{ route('departments') }}">Departments</a>
                                        </li>
                                    @endif
                                    @if (Gate::allows('allow-view', 'module-trip-categories'))
                                        <li class="submenu-item">
                                            <a @class([
                                                'submenu-link',
                                                'active' =>
                                                    Request::route()->named('trip-categories') ||
                                                    Request::route()->named('trip-category-details'),
                                            ]) href="{{ route('trip-categories') }}">Trip
                                                Categories</a>
                                        </li>
                                    @endif
                                    @if (Gate::allows('allow-view', 'module-vehicle-types'))
                                        <li class="submenu-item">
                                            <a @class([
                                                'submenu-link',
                                                'active' =>
                                                    Request::route()->named('vehicle-types') ||
                                                    Request::route()->named('vehicle-type-details'),
                                            ]) href="{{ route('vehicle-types') }}">Vehicle
                                                Types</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a @class(['nav-link', 'active' => Request::route()->named('about')])>
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em"
                                    fill="currentColor" class="bi bi-question-circle" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path fill-rule="evenodd"
                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">About</span>
                        </a>
                    </li>
                </ul> --}}
            </nav>
        </div>
    </div>
</div>
