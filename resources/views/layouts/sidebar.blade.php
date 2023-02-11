            <!-- ========== Left Sidebar Start ========== -->
            <div class="left side-menu">
                <div class="slimscroll-menu" id="remove-scroll">

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">
                        <!-- Left Menu Start -->
                        <ul class="metismenu" id="side-menu">
                            <li class="menu-title">Main</li>
                            <li>
                                <a href="{{ url('user.dashboard')}}" class="waves-effect">
                                    <i class="mdi mdi-view-dashboard"></i> <span> Dashboard </span>
                                </a>
                            </li>
                            <li class="menu-title">User Management</li>
                            @if(Auth::user()->level == 1)
                            <li>
                            <a href="{{ route('user.index') }}" class="waves-effect">
                                    <i class="mdi mdi-account-multiple"></i><span> User </span>
                            </a>
                            </li>
                            <li class="menu-title">Product Management</li>
                            <li>
                                <a href="{{ route('product.index') }}" class="waves-effect">
                                        <i class="mdi mdi-equal-box"></i><span> Product </span>
                                </a>
                            </li>
                            <li>
                                    <a href="{{ route('category.index') }}" class="waves-effect">
                                            <i class="mdi mdi-equal"></i><span> Category </span>
                                    </a>
                                </li>
                            @elseif(Auth::user()->level == 3)
                            <li>
                                <a href="{{ route('cashier.index') }}" class="waves-effect">
                                    <i class="mdi mdi-account-multiple"></i><span> Cashier </span>
                                </a>
                            </li>
                            @endif
                        </ul>

                    </div>
                    <!-- Sidebar -->
                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->
