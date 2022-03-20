

<body id="page-top">

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.index') }}">
            <div class="sidebar-brand-text mx-3"> Admin </div>
        </a>

        <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
        <li class="nav-item @if(\Illuminate\Support\Facades\Request::segment(2)=="panel") active @endif ">
            <a class="nav-link" href="{{route('admin.index')}}">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span></a>
        </li>

        <hr class="sidebar-divider">

        <div class="sidebar-heading">
            Content Management
        </div>
        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Facades\Request::segment(2)=="articles") in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapseTwo"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-edit"></i>
                <span>Articles</span>
            </a>
            <div id="collapseTwo" class="collapse @if(\Illuminate\Support\Facades\Request::segment(2) == "articles") in show @endif" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Article Settings:</h6>
                    <a class="collapse-item @if(\Illuminate\Support\Facades\Request::segment(2) == "articles" and !\Illuminate\Support\Facades\Request::segment(3) ) active @endif" href="{{route('articles.index')}}">All Articles</a>
                    <a class="collapse-item @if(\Illuminate\Support\Facades\Request::segment(3) == "create") active @endif" href="{{ route('articles.create') }}">Create Articles</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('category.index') }}"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-list"></i>
                <span>Categories</span>
            </a>

        </li>

        <li class="nav-item">
            <a class="nav-link @if(\Illuminate\Support\Facades\Request::segment(2)=="articles") in @else collapsed @endif" href="#" data-toggle="collapse" data-target="#collapsePage"
               aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-folder"></i>
                <span>Pages</span>
            </a>
            <div id="collapsePage" class="collapse @if(\Illuminate\Support\Facades\Request::segment(2) == "pages") in show @endif" aria-labelledby="headingPage" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Page Settings:</h6>
                    <a class="collapse-item @if(\Illuminate\Support\Facades\Request::segment(2) == "pages" and !\Illuminate\Support\Facades\Request::segment(3) ) active @endif" href="{{route('pages.index')}}">All Pages</a>
                    <a class="collapse-item @if(\Illuminate\Support\Facades\Request::segment(2) == "pages" and \Illuminate\Support\Facades\Request::segment(3) == "create") active @endif" href="{{ route('pages.create') }}">Create Page</a>
                </div>
            </div>
        </li>

        <!-- Divider -->
        <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            SETTINGS
        </div>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('admin.settings') }}">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Settings</span></a>
            </li>

                <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>

    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                <!-- Sidebar Toggle (Topbar) -->
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

                <!-- Topbar Navbar -->
                <ul class="navbar-nav ml-auto">

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-envelope fa-fw"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-danger badge-counter">{{ count($contacts) }}</span>
                        </a>
                        <!-- Dropdown - Messages -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="messagesDropdown">
                            <h6 class="dropdown-header">
                                Message Center
                            </h6>
                           @foreach($contacts as $contact)
                            <a class="dropdown-item d-flex align-items-center" href="#">
                                <div class="dropdown-list-image mr-3">
                                    <img class="rounded-circle" src="{{asset('back/img/undraw_profile_2.svg')}}"
                                         alt="...">
                                    <div class="status-indicator"></div>
                                </div>
                                <div>
                                    <div class="text-truncate">{{ $contact->message }}</div>
                                    <div class="small text-gray-500">{{ $contact->email }}  /  {{$contact->created_at->diffForHumans()}}</div>
                                </div>
                            </a>
                            @endforeach
                            <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                        </div>
                    </li>

                    <div class="topbar-divider d-none d-sm-block"></div>

                    <!-- Nav Item - User Information -->
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::getUser()->email }}</span>

                        </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                Profile
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                Settings
                            </a>
                            <a class="dropdown-item" href="#">
                                <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                Activity Log
                            </a>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Logout
                            </a>
                        </div>
                    </li>

                </ul>

            </nav>


            <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800"> @yield('title') </h1>
                    <a href="{{route('bloghome.index')}}" target="_blank" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
                            class="fas fa-globe fa-sm text-white-50"></i> Go Home</a>
                </div>
                </div>
