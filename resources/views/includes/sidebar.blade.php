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
                <p>@if (session('userDetails'))  <?php echo Session::get('userDetails.f_name'). " ".  Session::get
                            ('userDetails.l_name'); ?>
                    @endif</p>
                <p><a href="{{ URL::to('admin/logout') }}" >Sign out</a></p>
            </div>
        </div>
        {{--<!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        <!-- /.search form -->--}}
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?php $access_menu=Session::get('userDetails.access_id');?>
        <ul class="sidebar-menu">
            <li class="header">MAIN NAVIGATION</li>
            <li class="active treeview">
                <a href="{{ URL::to('admin/dashboard') }}">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>

            <li class="header">SAFEBAG 24</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gift"></i>
                    <span>PromoCode SB24</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/promocodelist') }}"><i class="fa fa-list"></i> Search
                            PromoCode</a></li>
                    <li><a href="{{ URL::to('admin/promocoderegistrationlist') }}"><i class="fa fa-list"></i> Code -
                            Registration</a></li>
                    <li><a href="{{ URL::to('admin/promocodetrackinglist') }}"><i class="fa fa-list"></i> Code -
                            Tracking</a></li>
                 </ul>
            </li>
            <li class="treeview">
                <a href="{{ URL::to('admin/trackinglist') }}">
                    <i class="fa fa-bar-chart"></i>
                    <span>Tracking SB24</span>
                </a>
                {{--<ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/trackinglist') }}"><i class="fa fa-list"></i> List All
                            Tracking</a></li>
                </ul>--}}
            </li>

            <li class="treeview">
                <a href="{{ URL::to('admin/transactionlist') }}">
                    <i class="fa fa-eur"></i>
                    <span>Transactions SB24</span>
                </a>
               {{-- <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/transactionlist') }}"><i class="fa fa-list"></i> List All
                            Transactions</a></li>
                </ul>--}}
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Partners</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/partnerslist') }}"><i class="fa fa-list"></i> List Partners </a></li>
                    <li><a href="{{ URL::to('admin/partnersadd') }}"><i class="fa fa-plus-circle"></i></i> Add Partner </a></li>
                </ul>
            </li>

            <?php
            if ($access_menu<3){
            ?>

            <li class="header">SAFE BAG</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-credit-card"></i>
                    <span>Sales Products by Airport</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/pricexairportlist') }}"><i class="fa fa-list"></i> List Airport Products </a></li>
                    <li><a href="{{ URL::to('admin/airportproductadd') }}"><i class="fa fa-plus-circle"></i></i> Add Airport Product </a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Terms and Conditions</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/termslist') }}"><i class="fa fa-list"></i> List Terms and Conditions</a></li>
                    <li><a href="{{ URL::to('admin/termsadd') }}"><i class="fa fa-plus-circle"></i> Add Terms and Conditions</a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-file-text-o"></i>
                    <span>Content Services Safe Bag</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/servicecontentlist') }}"><i class="fa fa-list"></i> List Content Services </a></li>
                    <li><a href="{{ URL::to('admin/servicecontentadd') }}"><i class="fa fa-plus-circle"></i> Add Content Service </a></li>
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
                    <li><a href="{{ URL::to('admin/sbairportadd') }}"><i class="fa fa-plus-circle"></i> Add SB Airport
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
                    <li><a href="{{ URL::to('admin/airportproductadd') }}"><i class="fa fa-plus-circle"></i> Add Airport Product </a></li>
                </ul>
            </li>


            <li class="treeview">
                <a href="#">
                    <i class="fa fa-fighter-jet"></i>
                    <span>Point Sales by Airports</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/airportcontentlist') }}"><i class="fa fa-list"></i> List Point
                            Sales</a></li>
                    <li><a href="{{ URL::to('admin/airportcontentadd') }}"><i class="fa fa-plus-circle"></i> Add
                            Point Sales</a></li>
                </ul>
            </li>


            <li class="header">CUSTOMER CARE</li>
            <li class="treeview">
                <a href="{{ URL::to('admin/cclist') }}">
                    <i class="fa fa-bar-chart"></i>
                    <span>Pratiche/Rimborsi</span>
                </a>
                {{--<ul class="treeview-menu">
                    <li><a href="{{ URL::to('admin/trackinglist') }}"><i class="fa fa-list"></i> List All
                            Tracking</a></li>
                </ul>--}}
            </li>



            <li class="header">OTHERS</li>
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
                    <li><a href="{{ URL::to('admin/airlineadd') }}"><i class="fa fa-plus-circle"></i> Add Airline </a></li>
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
                    <li><a href="{{ URL::to('admin/airportadd') }}"><i class="fa fa-plus-circle"></i> Add Airport </a></li>
                </ul>
            </li>

        <?php } ?>

        </ul>
    </section>
    <!-- /.sidebar -->
</aside>