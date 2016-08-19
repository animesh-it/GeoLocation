
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            <!-- BEGIN SIDEBAR -->
            <div class="page-sidebar-wrapper">
                <!-- BEGIN SIDEBAR -->
                <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                <div class="page-sidebar navbar-collapse collapse">
                    <!-- BEGIN SIDEBAR MENU -->
                    <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
                    <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
                    <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
                    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
                    <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
                    <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
                    <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                        <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
                        <li class="sidebar-toggler-wrapper hide">
                            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                            <div class="sidebar-toggler">
                                <span></span>
                            </div>
                            <!-- END SIDEBAR TOGGLER BUTTON -->
                        </li>
                        <li class="nav-item start ">
                            <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="icon-home"></i>
                                <span class="title">Dashboard</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Master Data</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url();?>Partnerbranches/ListAll" class="nav-link nav-toggle">
                                <i class="fa fa-user"></i>
                                <span class="title">Manage Partner Branches</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Users</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url();?>Users/ListAll" class="nav-link nav-toggle">
                                <i class="fa fa-user"></i>
                                <span class="title">Manage Users</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url();?>Users/Add" class="nav-link nav-toggle">
                                <i class="fa fa-user-plus"></i>
                                <span class="title">Add User</span>
                            </a>
                        </li>
                        <li class="heading">
                            <h3 class="uppercase">Employee</h3>
                        </li>
                        <li class="nav-item  ">
                            <a href="<?php echo base_url();?>Employee/ListAll" class="nav-link nav-toggle">
                                <i class="fa fa-map"></i>
                                <span class="title">Track Employee</span>
                            </a>
                        </li>
                    </ul>
                    <!-- END SIDEBAR MENU -->
                    <!-- END SIDEBAR MENU -->
                </div>
                <!-- END SIDEBAR -->
            </div>
            <!-- END SIDEBAR -->