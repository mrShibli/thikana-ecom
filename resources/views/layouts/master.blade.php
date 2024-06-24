<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/layets.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    <style>
        /* .glowcard {
            position: relative;
            display:block;
            background: linear-gradient(50deg, rgb(162 233 233) 0%, rgb(10 106 90) 100%);
            border-radius: 10px;
            color: white;
            padding: 20px 40px;
            font-family: Arial, sans-serif;
            overflow: hidden;
        } */

        .glowcard {
            position: relative;
            display: block;

            border-radius: 10px;
            color: white;
            padding: 21px 30px;
            font-family: Arial, sans-serif;
            overflow: hidden;
        }

        .glowcard1 {
            background: linear-gradient(50deg, rgb(30 195 195) 0%, rgb(100 147 255) 100%);
        }

        .glowcard2 {
            background: linear-gradient(50deg, rgb(7, 189, 189) 0%, rgb(163, 214, 24) 100%);
        }

        .glowcard3 {
            background: linear-gradient(50deg, rgb(67, 58, 196) 0%, rgb(100 147 255) 100%);
        }

        .glowcard4 {
            background: linear-gradient(50deg, rgb(30 195 195) 0%, rgb(128, 36, 151) 100%);
        }

        .glowcard-content {
            display: flex;
            align-items: center;
        }

        .glowcard .icon {
            font-size: 1.6em;
            margin-right: 10px;
        }

        .glowcard .count {
            font-size: 1.5em;
            font-weight: bold;
        }

        .glowcard .label {
            font-size: 1.2em;
            margin-top: -5px;
        }

        .glowcard::before,
        .glowcard::after {
            content: '';
            position: absolute;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            width: 200px;
            height: 200px;
        }

        /* .glowcard::before {
            top: -150px;
            left: -50px;
        } */

        .glowcard::before {
            top: -105px;
            left: 137px;
        }

        .glowcard::after {
            bottom: -50px;
            right: -50px;
        }

        .glowcard i {
            font-size: 10px;
            ;
        }
    </style>
    <style>
        .dataTables_wrapper tbody tr,
        td {
            border: none !important;
        }

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 18px;
            border-bottom: none !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            margin-left: 2px;
            border: 1px solid #ddd;
            background-color: #f7f7f7;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #80bdff;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 1px solid #80bdff;
            background-color: #80bdff;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1em;
            display: flex;
            justify-content: center;
        }

        .dataTables_wrapper .dataTables_filter {
            text-align: right;
        }

        .dataTables_wrapper .dataTables_length {
            margin-bottom: 1em;
        }

        .dataTables_wrapper .dataTables_info {
            margin-top: 1em;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1em;
        }

        table.dataTable {
            border-collapse: collapse !important;
        }

        table.dataTable thead th,
        table.dataTable tfoot th {
            background-color: #007bff;
            color: white;
        }

        table.dataTable tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        .btn-primary,
        .btn-danger {
            margin-right: 5px;
        }

        table.dataTable {
            border-collapse: collapse !important;
            width: 100%;
        }

        table.dataTable thead th,
        table.dataTable tfoot th {
            background-color: #4E9BE4;
            color: white;
        }

        table.dataTable tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        table.dataTable tbody tr:hover {
            background-color: #f1f1f1;
        }

        /* Pagination Button Styling */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em 1em;
            margin-left: 2px;
            border: 1px solid #ddd;
            background-color: #f7f7f7;
            color: #333;
            text-decoration: none;
            border-radius: 4px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: #007bff;
            color: #fff !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            color: #fff !important;
            border: 1px solid #007bff;
            background-color: #007bff;
        }

        .dataTables_wrapper .dataTables_paginate {
            margin-top: 1em;
            display: flex;
            justify-content: center;
        }

        /* Search Box Styling */
        .dataTables_wrapper .dataTables_filter {
            text-align: right;
            margin-bottom: 1em;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 0.5em;
        }

        /* Length Menu Styling */
        .dataTables_wrapper .dataTables_length {
            margin-bottom: 1em;
        }

        /* Info Styling */
        .dataTables_wrapper .dataTables_info {
            margin-top: 1em;
        }

        /* Buttons Styling */
        .dt-button {
            background-color: #007bff;
            color: white;
            border: 1px solid #007bff;
            border-radius: 4px;
            padding: 0.5em 1em;
            margin: 0.5em 0.5em 0.5em 0;
            cursor: pointer;
        }

        .dt-button:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        /* Action Buttons */
        .btn-primary,
        .btn-danger {
            margin-right: 5px;
        }
    </style>
    @yield('styles')
</head>

<body>



    <div class="main-wrapper">
        <!-- -navbar- -->
        <div class="header-container fixed-top">
            <header class="header navbar navbar-expand-sm expand-header">
                <div class="header-left d-flex">
                    <div class="logo">
                        <a href="{{ route('admin') }}">Thikana.shop</a>
                    </div>
                    <a href="#" id="toggleSidebar" class="sidebarCollapse" data-placement="button">
                        <span class="fas fa-bars"></span>
                    </a>
                </div>
                <div class="searchBar">
                    <input type="search" name="search" placeholder="Search..." id="">
                </div>
                <ul class="navbar-item flex-row  align-items-center py-2 ml-auto ">
                    <li class="nav-item dropdown user-profile-dropdown">
                        <a href="" class="nav-link user" id="notify" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/img/notification.png') }}" alt="" class="icon">
                            <p class="count">5</p>
                        </a>

                        <div class="dropdown-menu notification">
                            <div class="dp-main-menu">
                                <a href="" class="dropdown-item message-item">
                                    <img src="{{ asset('assets/img/email.png') }}" alt="" class="user-note">
                                    <div class="note-info-desmis">
                                        <div class="user-notify-info">
                                            <p class="note-name">server reboted</p>
                                            <p class="note-time">20 min ago</p>
                                        </div>
                                        <p class="status-link"><span class="fas fa-times"></span></p>
                                    </div>

                                </a>
                                <a href="" class="dropdown-item message-item">
                                    <img src="{{ asset('assets/img/email.png') }}" alt="" class="user-note">
                                    <div class="note-info-desmis">
                                        <div class="user-notify-info">
                                            <p class="note-name">software server reboted</p>
                                            <p class="note-time">20 min ago</p>
                                        </div>
                                        <p class="status-link"><span class="fas fa-times"></span></p>
                                    </div>

                                </a>
                                <a href="" class="dropdown-item message-item">
                                    <img src="{{ asset('assets/img/email.png') }}" alt="" class="user-note">
                                    <div class="note-info-desmis">
                                        <div class="user-notify-info">
                                            <p class="note-name">server reboted</p>
                                            <p class="note-time">20 min ago</p>
                                        </div>
                                        <p class="status-link"><span class="fas fa-times"></span></p>
                                    </div>

                                </a>


                            </div>
                        </div>

                    </li>
                    <li class="nav-item dropdown user-profile-dropdown">
                        <a href="" class="nav-link user" id="notify" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/img/email.png') }}" alt="" class="icon">
                            <p class="count">4</p>
                        </a>
                        <div class="dropdown-menu mail">
                            <div class="dp-main-menu">

                                <div class="email-info">
                                    <a href="" class="email-item">
                                        <img src="{{ asset('profile.svg') }}" alt="" class="user-email">
                                        <div class="note-info-email">
                                            <h2 class="name">Tawfiq Khan</h2>
                                            <p class="role">Super admin</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="email-info">
                                    <a href="" class="email-item">
                                        <img src="{{ asset('assets/img/man.png') }}" alt=""
                                            class="user-email">
                                        <div class="note-info-email">
                                            <h2 class="name">Tawfiq Khan</h2>
                                            <p class="role">Super admin</p>
                                        </div>
                                    </a>
                                </div>
                                <div class="email-info">
                                    <a href="" class="email-item">
                                        <img src="{{ asset('assets/img/man.png') }}" alt=""
                                            class="user-email">
                                        <div class="note-info-email">
                                            <h2 class="name">Tawfiq Khan</h2>
                                            <p class="role">Super admin</p>
                                        </div>
                                    </a>
                                </div>

                            </div>
                        </div>
                    </li>

                    <li class="nav-item dropdown user-profile-dropdown">
                        <a href="" class="nav-link user" id="notify" data-bs-toggle="dropdown">
                            <img src="{{ asset('profile.svg') }}" width="38" alt="" class="icon">
                        </a>

                        <div class="dropdown-menu usr">
                            <div class="dp-main-menu">

                                <div class="user-info">
                                    <div class="user-data">
                                        <img src="{{ asset('assets/img/man.png') }}" alt=""
                                            class="user-img">
                                        <div class="mt-3">
                                            <h2>{{ Auth::user()->name ?? '' }}</h2>
                                            <p> <small>{{ Auth::user()->email  ?? ''}}</small> </p>
                                            <p>Super admin</p>
                                        </div>
                                    </div>
                                    <div class="user-link">
                                        <a href="{{ route('admin.profile') }}"><i class="fas fa-user"></i>
                                            Profile</a>
                                        <a href=""><i class="fas fa-envelope"></i> Inbox</a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();"><i
                                                class="fas fa-lock-open"></i>

                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                        </a>

                                    </div>
                                </div>

                            </div>
                        </div>

                    </li>
                    <li class="nav-item dropdown user-profile-dropdown">
                        <a href="" class="nav-link user" id="notify" data-bs-toggle="dropdown">
                            <img src="{{ asset('assets/img/settings.png') }}" alt="" class="icon">
                        </a>
                        <div class="dropdown-menu setting">
                            <div class="dp-main-menu">
                                <div class="user-info">
                                    <div class="user-link mt-3">
                                        <a href=""><i class="fas fa-gear"></i> Settings</a>
                                        <a href=""><i class="fas fa-users"></i> Admin</a>
                                        <a href=""><i class="fas fa-pen"></i> Color</a>
                                        <a href=""><i class="fas fa-moon"></i> Theme</a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </li>
                </ul>

            </header>
        </div>
        <!-- -navbar-end -->


        <!-- --sidebar-start-- -->

        <div class="left-menu">
            <div class="menubar-content">
                <nav class="animated bounceInDown">
                    <ul id="sidebar">
                        <li class="active">
                            <a href="{{ route('admin') }}"><i class="fas fa-home"></i>Dashboard</a>
                        </li>

                        <li class="sub-menu">
                            <a href="#"><i class="fas fa-box-open"></i>Product <span
                                    class="fas fa-caret-down right"></span></a>
                            <ul class="left-menu-dp">
                                <li><a href="{{ route('product.index') }}"><i class="fas fa-list"></i>All Products</a></li>
                                <li><a href="{{ route('product.create') }}"><i class="fas fa-plus-circle"></i>Add
                                        Product</a></li>
                                <li><a href="{{ route('product_categories.index') }}"><i class="fas fa-tags"></i>Categories</a></li>
                                <li><a href="{{ route('product_categories.create') }}"><i class="fas fa-tags"></i>Create Categories</a></li>
                                <li><a href="#"><i class="fas fa-star"></i>Reviews</a></li>
                                <li><a href="#"><i class="fas fa-warehouse"></i>Stock Management</a></li>
                                <li><a href="#"><i class="fas fa-cog"></i>Settings</a></li>
                            </ul>
                        </li>


                        <li class="sub-menu">
                            <a href="#"><i class="fas fa-user"></i>Users <span
                                    class="fas fa-caret-down right"></span></a>
                            <ul class="left-menu-dp">
                                <li><a href="{{ route('admin.users') }}"><i class="fas fa-user-circle"></i>All
                                        Users</a></li>
                                <li><a href="#"><i class="fas fa-fingerprint"></i>Security &amp; Privacy</a>
                                </li>
                                <li><a href="#"><i class="fas fa-key"></i>Password</a></li>
                                <li><a href="#"><i class="fas fa-bell"></i>Notification</a></li>
                            </ul>
                        </li>



                        <li class="sub-menu">
                            <a href="#"><i class="fas fa-tools"></i>Settings <span
                                    class="fas fa-caret-down right"></span></a>
                            <ul class="left-menu-dp">
                                <li><a href="#"><i class="fas fa-globe"></i>Website Settings</a></li>
                                <li><a href="#"><i class="fas fa-heading"></i>Header Settings</a></li>
                                <li><a href="#"><i class="fas fa-shoe-prints"></i>Footer Settings</a></li>
                                <li><a href="#"><i class="fas fa-shield-alt"></i>Security Settings</a></li>
                                <li><a href="#"><i class="fas fa-envelope"></i>SMTP Setup</a></li>
                                <li><a href="#"><i class="fas fa-lock"></i>Login Activity</a></li>
                                <li><a href="#"><i class="fas fa-user-secret"></i>Privacy Settings</a></li>
                                <li><a href="#"><i class="fas fa-bell"></i>Notification Settings</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="#"><i class="fas fa-copy"></i>Pages <span
                                    class="fas fa-caret-down right"></span></a>
                            <ul class="left-menu-dp">
                                <li><a href="#"><i class="fas fa-file-alt"></i>All Pages</a></li>
                                <li><a href="#"><i class="fas fa-file-medical"></i>Create Page</a></li>
                            </ul>
                        </li>

                        <li class="sub-menu">
                            <a href="#"><i class="fas fa-blog"></i>Blog <span
                                    class="fas fa-caret-down right"></span></a>
                            <ul class="left-menu-dp">
                                <li><a href="#"><i class="fas fa-list"></i>All Posts</a></li>
                                <li><a href="#"><i class="fas fa-pencil-alt"></i>Create Post</a></li>
                                <li><a href="#"><i class="fas fa-edit"></i>Edit Post</a></li>
                                <li><a href="#"><i class="fas fa-archive"></i>Archived Posts</a></li>
                                <li><a href="#"><i class="fas fa-tags"></i>Categories</a></li>
                                <li><a href="#"><i class="fas fa-comments"></i>Comments</a></li>
                            </ul>
                        </li>


                        <li>
                            <a href=""><i class="fas fa-bell"></i>Subscripton</a>
                        </li>

                        <li>
                            <a href=""><i class="fas fa-envelope"></i>Contacts</a>
                        </li>

                        <li>
                            <a href=""><i class="fas fa-play"></i>Media</a>
                        </li>

                        <li>
                            <a href=""><i class="fas fa-list"></i>Sliders</a>
                        </li>


                    </ul>
                </nav>
            </div>
        </div>

        <!-- --sidebar-end-- -->

        <!-- --Main wrapper-start-- -->
        <div class="content-wrapper">

            @yield('content')

        </div>
        <!-- --Main wrapper-end-- -->


    </div>




    <!-- ----------------------------js---------------------------------------- -->

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @yield('scripts')
</body>

</html>
