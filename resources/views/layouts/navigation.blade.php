<header id="header" class="header fixed-top d-flex align-items-center">
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{route('dashboard')}}"
           class="logo d-flex align-items-center">
{{--                        <img--}}
{{--                            src="{{asset('/icons/main-logo-384x384.png')}}" alt="">--}}
            <span class="d-none d-lg-block">Admin</span> </a> <i
            class="bi bi-list toggle-sidebar-btn"></i></div>
    <div class="search-bar">
        <div class="search-form d-flex align-items-center" style="top: 100px">
            <input type="text" name="query" id="query"
                   placeholder="Search"
                   title="Enter search keyword" onkeyup="generalSearch()">
            {{--            <button type="submit" title="Search"><i class="bi bi-search"></i></button>--}}
        </div>
        <div class="card sugg-mobile">
            <div class="card-body">
                <h5 class="card-title">Suggestions</h5>
                <div class="getSugg">
                    @include('includes.search-sugg')
                </div>
            </div>
        </div>

    </div>
    <div style="display: flex; justify-content: center;">
        <div class="card sugg" style="display:none;position: absolute;top: 61px; padding: 20px 30px;z-index: 999">
            <div class="card-body">
                <div class="getSugg">
                    @include('includes.search-sugg')
                </div>
            </div>


        </div>
    </div>


    @isset($notis)
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">
                <li class="nav-item d-block d-lg-none"><a class="nav-link nav-icon search-bar-toggle " href="#"> <i
                            class="bi bi-search"></i> </a></li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"> <i class="bi bi-bell"></i> <span
                            class="badge bg-primary badge-number">{{$notis->count()}}</span> </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                        <li class="dropdown-header"> You have {{$notis->count()}} new notifications <a href="#"><span
                                    class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        @forelse($notis as $noti)
                            <li class="notification-item">
                                <i class="bi bi-exclamation-circle text-warning"></i>
                                <div>
                                    @php
                                        $start = \Carbon\Carbon::parse($noti->created_at);
                                        $end = \Carbon\Carbon::now()->addDays(1);
                                       $parseEnd =  \Carbon\Carbon::parse($end);
                                        $subDays = $start->diffInDays($parseEnd);
                                    @endphp
                                    <h4>{{$noti->title}}</h4>
                                    <p>{!!$noti->description!!}</p>
                                    <p>{{$noti->created_at->format('d-m-Y') == \Carbon\Carbon::now()->format('d-m-Y') ? 'Today ' . $noti->created_at->format('H:i') : \Carbon\Carbon::now()->subDays($subDays)->diffForHumans()}}</p>
                                </div>
                            </li>
                        @empty
                            none
                        @endforelse

                        {{--                    <li>--}}
                        {{--                        <hr class="dropdown-divider">--}}
                        {{--                    </li>--}}
                        {{--                    <li class="notification-item">--}}
                        {{--                        <i class="bi bi-check-circle text-success"></i>--}}
                        {{--                        <div>--}}
                        {{--                            <h4>Sit rerum fuga</h4>--}}
                        {{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
                        {{--                            <p>2 hrs. ago</p>--}}
                        {{--                        </div>--}}
                        {{--                    </li>--}}
                        {{--                    <li>--}}
                        {{--                        <hr class="dropdown-divider">--}}
                        {{--                    </li>--}}
                        {{--                    <li class="notification-item">--}}
                        {{--                        <i class="bi bi-info-circle text-primary"></i>--}}
                        {{--                        <div>--}}
                        {{--                            <h4>Dicta reprehenderit</h4>--}}
                        {{--                            <p>Quae dolorem earum veritatis oditseno</p>--}}
                        {{--                            <p>4 hrs. ago</p>--}}
                        {{--                        </div>--}}
                        {{--                    </li>--}}
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer"><a href="#">Show all notifications</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown"> <i
                            class="bi bi-chat-left-text"></i>
                        <span class="badge bg-success badge-number">3</span> </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow messages">
                        <li class="dropdown-header"> You have 3 new messages <a href="#"><span
                                    class="badge rounded-pill bg-primary p-2 ms-2">View all</span></a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="message-item">
                            <a href="#">
                                {{--                            <img src="assets/img/messages-1.jpg" alt="" class="rounded-circle">--}}
                                <div>
                                    <h4>Jassa</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>4 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="message-item">
                            <a href="#">
                                {{--                            <img src="assets/img/messages-2.jpg" alt="" class="rounded-circle">--}}
                                <div>
                                    <h4>Jassa</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>6 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="message-item">
                            <a href="#">
                                <img src="assets/img/messages-3.jpg" alt="" class="rounded-circle">
                                <div>
                                    <h4>Jassa</h4>
                                    <p>Velit asperiores et ducimus soluta repudiandae labore officia est ut...</p>
                                    <p>8 hrs. ago</p>
                                </div>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li class="dropdown-footer"><a href="#">Show all messages</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown pe-3">
                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <img
                            src="{{asset('/icons/PNG/9.png')}}" alt="Profile" class="rounded-circle"> <span
                            class="d-none d-md-block dropdown-toggle ps-2">{{auth()->user()->name}}</span> </a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6>{{auth()->user()->name}}</h6>
                            <span>Web Designer</span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="{{url('/profile')}}"> <i
                                    class="bi bi-person"></i> <span>My Profile</span> </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="{{url('/profile')}}"> <i
                                    class="bi bi-gear"></i> <span>Account Settings</span> </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="pages-faq.html"> <i
                                    class="bi bi-question-circle"></i> <span>Need Help?</span> </a></li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li><a class="dropdown-item d-flex align-items-center" href="{{ route('logout') }}"
                               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                <i class="bi bi-box-arrow-right"></i> <span>Sign Out</span> </a></li>
                    </ul>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </nav>
    @endisset

</header>

<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">
        <li class="nav-item"><a class="nav-link " href="{{route('dashboard')}}"> <i class="bi bi-grid"></i> <span>Dashboard</span>
            </a></li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#"> <i
                    class="bi bi-menu-button-wide"></i><span>Projects</span><i class="bi bi-chevron-down ms-auto"></i>
            </a>
            <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="{{route('projects-overview')}}"> <i class="bi bi-circle"></i><span>overview</span> </a>
                </li>
                <li><a href="{{route('view-project')}}"> <i class="bi bi-circle"></i><span>Add</span> </a></li>
                {{--                <li><a href="components-badges.html"> <i class="bi bi-circle"></i><span>Badges</span> </a></li>--}}
            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#"> <i
                    class="bi bi-journal-text"></i><span>Customers</span><i class="bi bi-chevron-down ms-auto"></i> </a>
            <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                <li><a href="{{route('overview')}}"> <i class="bi bi-circle"></i><span>Overview</span> </a></li>
                <li><a href="{{route('customer-form')}}"> <i class="bi bi-circle"></i><span>Register</span> </a></li>

            </ul>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('calendar')}}"> <i
                    class="bi bi-calendar"></i>
                <span>Calendar</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('pages')}}"> <i
                    class="bi bi-layout-text-window-reverse"></i>
                <span>PDF</span>
            </a>
        </li>
 <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('hours-overview')}}"> <i
                    class="bi bi-hourglass"></i>
                <span>Hours</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link collapsed" href="{{route('trash')}}"> <i
                    class="bi bi-trash"></i>
                <span>Trash</span>
            </a>
        </li>
        {{--        <li class="nav-item">--}}
        {{--            <a class="nav-link collapsed" data-bs-toggle="collapse" href="{{route('view-Page')}}"> <i--}}
        {{--                    class="bi bi-gem"></i><span>Pills</span>--}}
        {{--            </a>--}}

        {{--        </li>--}}
        {{--        <li class="nav-heading">Pages</li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="users-profile.html"> <i class="bi bi-person"></i>--}}
        {{--                <span>Profile</span> </a></li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="pages-faq.html"> <i class="bi bi-question-circle"></i>--}}
        {{--                <span>F.A.Q</span> </a></li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="pages-contact.html"> <i class="bi bi-envelope"></i>--}}
        {{--                <span>Contact</span> </a></li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="pages-register.html"> <i class="bi bi-card-list"></i>--}}
        {{--                <span>Register</span> </a></li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="pages-login.html"> <i--}}
        {{--                    class="bi bi-box-arrow-in-right"></i> <span>Login</span> </a></li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="pages-error-404.html"> <i--}}
        {{--                    class="bi bi-dash-circle"></i> <span>Error 404</span> </a></li>--}}
        {{--        <li class="nav-item"><a class="nav-link collapsed" href="pages-blank.html"> <i class="bi bi-file-earmark"></i>--}}
        {{--                <span>Blank</span> </a></li>--}}
    </ul>
</aside>

