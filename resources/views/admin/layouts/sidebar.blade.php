<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="side-menu">
            <li class="sidebar-search">
                <div class="input-group custom-search-form">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </span>
                </div>
                <!-- /input-group -->
            </li>
            <li>
                <a href="{{ url('admin/dashboard') }}"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
            {{--     <a class="{{ setActive(['admin/menu']) }}" href="{{ url('admin/menu') }}"><i class="fa fa-sitemap fa-fw"></i> Menu</a>
                <!-- /.nav-second-level -->
            </li> --}}
            <li>
                <a class="{{ setActive(['admin/user']) }}" href="{{ url('admin/users') }}"><i class="fa fa-users fa-fw"></i> Users</a>
                <!-- /.nav-second-level -->
            </li>
            <li>
                <a class="{{ setActive(['admin/comment']) }}" href="{{ url('admin/comments') }}"><i class="fa fa-comment fa-fw"></i> Comments</a>
                <!-- /.nav-second-level -->
            </li>
            <li class="{{ setActive(['admin/post', 'admin/category', 'admin/categories', 'admin/tag']) }}">
                <a href="#"><i class="fa fa-book fa-fw"></i> Posts<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a class="{{ setActive(['admin/post/create']) }}" href="{{ url('admin/post/create') }}">New Post</a></li>
                    <li><a class="{{ setActive(['admin/posts']) }}" href="{{ url('admin/posts') }}">Posts List</a></li>
                    <li>
                        <a class="{{ setActive(['admin/categories', 'admin/category']) }}" href="{{ url('admin/categories') }}"><i class="fa fa-tasks fa-fw"></i> Categories List</a>
                    </li>
                    <li>
                        <a class="{{ setActive(['admin/tag']) }}" href="{{ url('admin/tags') }}"><i class="fa fa-tasks fa-fw"></i> Tags List</a>
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li>
                <a href="#"><i class="fa fa-sitemap fa-fw"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li><a href="#">Second Level Item</a></li>
                    <li><a href="#">Second Level Item</a></li>
                    <li>
                        <a href="#">Third Level <span class="fa arrow"></span></a>
                        <ul class="nav nav-third-level">
                            <li><a href="#">Third Level Item</a></li>
                            <li><a href="#">Third Level Item</a></li>
                            <li><a href="#">Third Level Item</a></li>
                            <li><a href="#">Third Level Item</a></li>
                        </ul>
                        <!-- /.nav-third-level -->
                    </li>
                </ul>
                <!-- /.nav-second-level -->
            </li>
        </ul>
        <!-- /#side-menu -->
    </div>
    <!-- /.sidebar-collapse -->
</nav>
<!-- /.navbar-static-side -->
