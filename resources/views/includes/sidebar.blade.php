<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                @if (session('userDetails'))
                    <?php $pict = Session::get('userDetails.profile_picture'); if(!empty($pict))  {   ?>
                    <img src="{{ asset('/adminpictures') }}/<?php echo Session::get('userDetails.profile_picture'); ?>" class="img-circle" alt="User Image"/>
                    <?php }     else    {   ?>
                    <img src="{{ asset('/public/images/profile_foto.png') }}" class="user-image" alt="User Image"/>
                    <?php } ?>
                @else
                    <img src="{{ asset('/public/images/blank-male.jpg') }}" class="img-circle" alt="User Image" />
                @endif
            </div>
            <div class="pull-left info">
                <p>@if (session('userDetails'))  <?php echo Session::get('userDetails.f_name'). " ".  Session::get('userDetails.l_name'); ?>  @endif</p>
                <p><a href="{{ URL::to('admin/logout') }}" >Sign out</a></p>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="{{ URL::to('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>Users</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/userlist') }}"><i class="fa fa-list"></i> List Users</a></li>
                    <li><a href="{{ URL::to('admin/useradd') }}"><i class="fa fa-user-plus"></i> Add Users</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-plane"></i>
                    <span>Airlines</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/airlineslist') }}"><i class="fa fa-list"></i> List Airlines </a></li>
                    <li><a href="{{ URL::to('admin/airlineadd') }}"><i class="fa fa-plane"></i> Add Airline </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-rocket"></i>
                    <span>Airports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/airportslist') }}"><i class="fa fa-list"></i> List Airports </a></li>
                    <li><a href="{{ URL::to('admin/airportadd') }}"><i class="fa fa-rocket"></i> Add Airport </a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-rocket"></i>
                    <span>Safe Bag Airports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/sbairportslist') }}"><i class="fa fa-list"></i> List SB Airports
                        </a></li>
                    <li><a href="{{ URL::to('admin/sbairportadd') }}"><i class="fa fa-rocket"></i> Add SB Airport
                        </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fighter-jet"></i>
                    <span>Products by Airport</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/airportproductlist') }}"><i class="fa fa-list"></i> List Airport Products </a></li>
                    <li><a href="{{ URL::to('admin/airportproductadd') }}"><i class="fa fa-fighter-jet"></i> Add Airport Product </a></li>
                </ul>
            </li>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>