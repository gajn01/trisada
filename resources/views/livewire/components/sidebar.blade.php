<div id="app-sidepanel" class="app-sidepanel">
    <div id="sidepanel-drop" class="sidepanel-drop"></div>
    <div class="sidepanel-inner d-flex flex-column">
        <a href="#" id="sidepanel-close" class="sidepanel-close d-xl-none">&times;</a>
        <div class="app-branding">
            <a class="app-logo" href="{{ url('dashboard') }}"><img class="logo-icon me-2" src="{{ url('asset/img/small.png') }}"
                    alt="logo"><span class="logo-text"></span></a>
        </div>
        <!--//app-branding-->

        <nav id="app-nav-main" class="app-nav app-nav-main flex-grow-1">
            <ul class="app-menu list-unstyled accordion" id="menu-accordion">

                    <li class="nav-item">
                        <a class="nav-link {{ Request::routeIs('dashboard') ? 'active' : '' }}"
                            href="{{ url('dashboard') }}">
                            <span class="nav-icon">
                                <svg viewBox="0 0 16 16" class="bi " fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M7.646 1.146a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 .146.354v7a.5.5 0 0 1-.5.5H9.5a.5.5 0 0 1-.5-.5v-4H7v4a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5v-7a.5.5 0 0 1 .146-.354l6-6zM2.5 7.707V14H6v-4a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v4h3.5V7.707L8 2.207l-5.5 5.5z" />
                                    <path fill-rule="evenodd"
                                        d="M13 2.5V6l-2-2V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                @if (Gate::allows('allow-view', 'module-schedule-management'))
                    <li class="nav-item">
                        <a class="nav-link {{ Request::is('schedule') || Request::is('schedule/form*') || Request::is('schedule/details*') ? 'active' : '' }}"
                            href="{{ url('schedule') }}">
                            <span class="nav-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                    fill="currentColor" class="bi bi-calendar-event" viewBox="0 0 16 16">
                                    <path
                                        d="M11 6.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5v-1z" />
                                    <path
                                        d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5zM1 4v10a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V4H1z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Schedule</span>
                        </a>
                    </li>
                @endif
                 
            </ul>
        </nav>
        <div class="app-sidepanel-footer">
            <nav class="app-nav app-nav-footer">
                <ul class="app-menu footer-menu list-unstyled">
                    <li class="nav-item has-submenu">
                        <a class="nav-link submenu-toggle {{ Request::routeIs('critical-deviation') || Request::routeIs('dropdown') || Request::routeIs('dropdown/menu*') || Request::routeIs('settings') || Request::routeIs('sanitary') || Request::routeIs('category') ? 'active' : '' }}"
                            href="#" data-bs-toggle="collapse" data-bs-target="#submenu-4"
                            aria-expanded="false" aria-controls="submenu-4">
                            <span class="nav-icon">
                                <svg viewBox="0 0 16 16" class="bi bi-columns-gap" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8.837 1.626c-.246-.835-1.428-.835-1.674 0l-.094.319A1.873 1.873 0 0 1 4.377 3.06l-.292-.16c-.764-.415-1.6.42-1.184 1.185l.159.292a1.873 1.873 0 0 1-1.115 2.692l-.319.094c-.835.246-.835 1.428 0 1.674l.319.094a1.873 1.873 0 0 1 1.115 2.693l-.16.291c-.415.764.42 1.6 1.185 1.184l.292-.159a1.873 1.873 0 0 1 2.692 1.116l.094.318c.246.835 1.428.835 1.674 0l.094-.319a1.873 1.873 0 0 1 2.693-1.115l.291.16c.764.415 1.6-.42 1.184-1.185l-.159-.291a1.873 1.873 0 0 1 1.116-2.693l.318-.094c.835-.246.835-1.428 0-1.674l-.319-.094a1.873 1.873 0 0 1-1.115-2.692l.16-.292c.415-.764-.42-1.6-1.185-1.184l-.291.159A1.873 1.873 0 0 1 8.93 1.945l-.094-.319zm-2.633-.283c.527-1.79 3.065-1.79 3.592 0l.094.319a.873.873 0 0 0 1.255.52l.292-.16c1.64-.892 3.434.901 2.54 2.541l-.159.292a.873.873 0 0 0 .52 1.255l.319.094c1.79.527 1.79 3.065 0 3.592l-.319.094a.873.873 0 0 0-.52 1.255l.16.292c.893 1.64-.902 3.434-2.541 2.54l-.292-.159a.873.873 0 0 0-1.255.52l-.094.319c-.527 1.79-3.065 1.79-3.592 0l-.094-.319a.873.873 0 0 0-1.255-.52l-.292.16c-1.64.893-3.433-.902-2.54-2.541l.159-.292a.873.873 0 0 0-.52-1.255l-.319-.094c-1.79-.527-1.79-3.065 0-3.592l.319-.094a.873.873 0 0 0 .52-1.255l-.16-.292c-.892-1.64.902-3.433 2.541-2.54l.292.159a.873.873 0 0 0 1.255-.52l.094-.319z" />
                                    <path fill-rule="evenodd"
                                        d="M8 5.754a2.246 2.246 0 1 0 0 4.492 2.246 2.246 0 0 0 0-4.492zM4.754 8a3.246 3.246 0 1 1 6.492 0 3.246 3.246 0 0 1-6.492 0z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">Settings</span>
                            <span class="submenu-arrow">
                                <svg viewBox="0 0 16 16" class="bi bi-chevron-down" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z" />
                                </svg>
                            </span>
                        </a>
                        <div id="submenu-4" @class([
                            'collapse submenu submenu-4',
                            'show' =>
                                Request::routeIs('user-management') ||
                                Request::routeIs('dropdown') ||
                                Request::routeIs('dropdown/menu*') ||
                                Request::routeIs('settings') ||
                                Request::routeIs('sanitary') ||
                                Request::routeIs('category') ||
                                Request::routeIs('critical-deviation'),
                        ]) data-bs-parent="#menu-accordion">
                            <ul class="submenu-list list-unstyled">
                                @if (Gate::allows('allow-view', 'module-user-management'))
                                    <li class="submenu-item "><a @class(['submenu-link', 'active' => Request::routeIs('user-management')]) href="{{ url('user-management') }}">Account Management</a></li>
                                @endif
                                @if (Gate::allows('allow-view', 'module-category-management'))
                                    <li class="submenu-item "><a @class(['submenu-link', 'active' => Request::routeIs('category')])  href="{{ url('settings/category') }}">Category</a></li>
                                @endif
                                @if (Gate::allows('allow-view', 'module-critical-deviation-management'))
                                    <li class="submenu-item"><a @class(['submenu-link','active' => Request::routeIs('critical-deviation'),])href="{{ url('settings/critical-deviation') }}">Critical Deviation</a></li>
                                @endif
                                @if (Gate::allows('allow-view', 'module-sanitation-defect-management'))
                                    <li class="submenu-item"><a class="submenu-link {{ Request::routeIs('sanitary') ? 'active' : '' }}"href="{{ url('settings/sanitary') }}">Sanitation Defect</a></li>
                                @endif
                                @if (Gate::allows('allow-view', 'module-dropdown-management'))
                                    <li class="submenu-item"><a class="submenu-link {{ Request::routeIs('dropdown') || Request::is('dropdown/menu*') ? 'active' : '' }}"href="{{ url('settings/dropdown') }}">Dropdown</a></li>
                                @endif
                            </ul>
                        </div>
                    </li>
                  {{--   <li class="nav-item">
                        <a class="nav-link" href="help.html">
                            <span class="nav-icon">
                                <svg viewBox="0 0 16 16" class="bi bi-question-circle" fill="currentColor"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                                    <path
                                        d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286zm1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94z" />
                                </svg>
                            </span>
                            <span class="nav-link-text">About</span>
                        </a>
                    </li> --}}
                </ul>
                <!--//footer-menu-->
            </nav>
        </div>
    </div>
</div>