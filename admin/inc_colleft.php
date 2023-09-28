<!-- START SIDEBAR-->
<nav class="page-sidebar" style="position: fixed !important;" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="./assets/img/Users/<?php echo $_SESSION['UserImg'];?>" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong"><?php echo $_SESSION['Fname'];?>&nbsp;&nbsp;<?php echo $_SESSION['Lname'];?></div><small>Administrator</small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a class="active" href="?p=Home"><i class="sidebar-item-icon fa fa-th-large"></i>
                            <span class="nav-label">Dashboard</span>
                        </a>
                    </li>
                    <li class="heading">FEATURES</li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-dropbox"></i>
                            <span class="nav-label">Products</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="?p=OvProducts">Overview</a>
                            </li>
                            <li>
                                <a href="?p=addProduct">Add Products</a>
                            </li>
                            <li>
                                <a href="?p=categ">Categories</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?p=Orders"><i class="sidebar-item-icon fa fa-shopping-cart"></i>
                            <span class="nav-label">Orders</span></a>
                        
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-users"></i>
                            <span class="nav-label">Customers</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="?p=Customers">Customers</a>
                            </li>
                            <li>
                                <a href="?p=">Add Customers</a>
                            </li>
                            <li>
                                <a href="?p="></a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="?p=Coupons"><i class="sidebar-item-icon fa fa-gift"></i>
                            <span class="nav-label">Promotions</span></a>
                        
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-envelope"></i>
                            <span class="nav-label">MailBox</span><i class="fa fa-angle-left arrow"></i></a>
                        <ul class="nav-2-level collapse">
                            <li>
                                <a href="?p=mailbox">Inbox</a>
                            </li>
                            <li>
                                <a href="?p=Compose">Compose</a>
                            </li>
                            <li>
                                <a href="?p=viewmail">Read</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->