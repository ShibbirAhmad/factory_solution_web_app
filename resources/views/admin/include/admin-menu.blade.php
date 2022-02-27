<div class="sidebar-wrapper sidebar-theme">

    <nav id="compactSidebar">
        <ul class="navbar-nav theme-brand flex-row">
            <li class="nav-item theme-logo">
                <a href="/admin/home">
                    <img src="{{ asset('admin') }}/assets/img/90x90.jpg" class="navbar-logo" alt="logo">
                </a>
            </li>
        </ul>
        <ul class="menu-categories">
            <li class="menu active">
                <a href="#dashboard" data-active="true" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-home">
                                <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                                <polyline points="9 22 9 12 15 12 15 22"></polyline>
                            </svg>
                        </div>
                        <span>Home</span>
                    </div>
                </a>
            </li>


            <li class="menu">
                <a href="#cashbook" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fa fa-book fa-2x"></i>
                        </div>
                        <span>Cashbook</span>
                    </div>
                </a>
            </li>


            <li class="menu">
                <a href="#purchase" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fas fa-list fa-2x"></i>
                        </div>
                        <span>Purchase</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </li>


           {{-- Order Start --}}
            <li class="menu">
                <a href="#clientOrder" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons"> <i class="fal fa-clipboard fa-2x"></i> </div>
                        <span> Production</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </li>
            {{-- Order End --}}


            <li class="menu">
                <a href="#design" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons"> <i class="far fa-images fa-2x"></i></div>
                        <span>Design</span>
                    </div>
                </a>
            </li>


            <li class="menu">
                <a href="#products" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fas fa-tags fa-2x"></i>
                        </div>
                        <span>Products</span>
                    </div>
                </a>
            </li>





            <li class="menu">
                <a href="#due_receive" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-layout">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <line x1="3" y1="9" x2="21" y2="9"></line>
                                <line x1="9" y1="21" x2="9" y2="9"></line>
                            </svg>
                        </div>
                        <span>Due Receive</span>
                    </div>
                </a>
            </li>



            <li class="menu">
                <a href="#warehouse" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="far fa-building fa-2x"></i>
                        </div>
                        <span>Warehouse</span>
                    </div>
                </a>
            </li>


            <li class="menu">
                <a href="#sales" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="far fa-list-alt fa-2x"></i>
                        </div>
                        <span>Sales</span>
                    </div>
                </a>
            </li>

            <li class="menu">
                <a href="#hr" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fas fa-user-secret fa-2x"></i>
                        </div>
                        <span>HR</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </li>

            {{-- Admin Strat --}}
            <li class="menu">
                <a href="#admin" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <span>Admin</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </li>
            {{-- Admin End --}}


            <li class="menu">
                <a href="#supplier" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <span>Suppliers</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </li>



            <li class="menu">
                <a href="#clients" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fas fa-users fa-2x"></i>
                        </div>
                        <span>Clients</span>
                    </div>
                </a>
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                    stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                    class="feather feather-chevron-left">
                    <polyline points="15 18 9 12 15 6"></polyline>
                </svg>
            </li>




            <li class="menu">
                <a href="#app" data-active="false" class="menu-toggle">
                    <div class="base-menu">
                        <div class="base-icons">
                            <i class="fa fa-cogs fa-2x"></i>
                        </div>
                        <span>Settings</span>
                    </div>
                </a>
            </li>

        </ul>
    </nav>

    @include('admin.include.admin-sub-menu')

</div>
