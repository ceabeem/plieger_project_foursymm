<div class="page-sidebar-wrapper page-sidebar-fixed">
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
            <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            <li class="sidebar-toggler-wrapper hide">
                <div class="sidebar-toggler">
                    <span></span>
                </div>
            </li>
            <!-- END SIDEBAR TOGGLER BUTTON -->
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <!-- <li class="sidebar-search-wrapper">
                BEGIN RESPONSIVE QUICK SEARCH FORM
                DOC: Apply "sidebar-search-bordered" class the below search form to have bordered search box
                DOC: Apply "sidebar-search-bordered sidebar-search-solid" class the below search form to have bordered & solid search box
                <form class="sidebar-search  " action="page_general_search_3.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit">
                                <i class="icon-magnifier"></i>
                            </a>
                        </span>
                    </div>
                </form>
                END RESPONSIVE QUICK SEARCH FORM
            </li> -->
            <li class="nav-item <?php echo ((Request::routeIs('teamleader.dashboard'))? 'active': '') ?>">
                <a href="{{ route('teamleader.dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('teamleader.team'))? 'active': '') ?>">
                <a href="{{ route('teamleader.team') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title"> Team </span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item 
                            <?php 
                                if((Request::routeIs('teamleader.assigntask'))){
                                echo ((Request::routeIs('teamleader.assigntask'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('teamleader.task'))){
                                    echo ((Request::routeIs('teamleader.task'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('teamleader.review'))){
                                    echo ((Request::routeIs('teamleader.review'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('teamleader.reviewpending'))){
                                    echo ((Request::routeIs('teamleader.reviewpending'))? 'start active open': '') ;
                                }
                               
                            ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-database"></i>
                                    <span class="title">Data Circle</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?php echo ((Request::routeIs('teamleader.assigntask'))? 'active': '') ?>">
                                        <a href="{{ route('teamleader.assigntask') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-tasks"></i>
                                            <span class="title">Assign Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('teamleader.task'))? 'active': '') ?>">
                                        <a href="{{ route('teamleader.task') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-tasks"></i>
                                            <span class="title">Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('teamleader.review'))? 'active': '') ?>">
                                            <a href="{{ route('teamleader.review') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-calendar-check-o"></i>
                                                <span class="title">Review</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('teamleader.reviewpending'))? 'active': '') ?>">
                                        <a href="{{ route('teamleader.reviewpending') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-repeat"></i>
                                            <span class="title">Cross Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                
                                </ul>
            </li>
            <li class="nav-item 
                            <?php 
                                if((Request::routeIs('GIS.teamleader.assigntask',))){
                                echo ((Request::routeIs('GIS.teamleader.assigntask'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.teamleader.task',))){
                                    echo ((Request::routeIs('GIS.teamleader.task'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.teamleader.review',))){
                                    echo ((Request::routeIs('GIS.teamleader.review'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.teamleader.reviewpending',))){
                                    echo ((Request::routeIs('GIS.teamleader.reviewpending'))? 'start active open': '') ;
                                }
                               
                            ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fa fa-database"></i>
                                    <span class="title">GIS</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu">
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.teamleader.assigntask'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.teamleader.assigntask') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-tasks"></i>
                                            <span class="title">Assign Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.teamleader.task'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.teamleader.task') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-tasks"></i>
                                            <span class="title">Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.teamleader.review'))? 'active': '') ?>">
                                            <a href="{{ route('GIS.teamleader.review') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-calendar-check-o"></i>
                                                <span class="title">Review</span>
                                                <span class="selected"></span>
                                            </a>
                                        </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.teamleader.reviewpending'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.teamleader.reviewpending') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-repeat"></i>
                                            <span class="title">Cross Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                
                                </ul>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('teamleader.timesheet'))? 'active': '') ?>">
                <a href="{{ route('teamleader.timesheet') }}" class="nav-link nav-toggle">
                    <i class="fa fa-calendar"></i>
                    <span class="title">Timesheet</span>
                    <span class="selected"></span>
                </a>
            </li>
            
            
            
            

           
           
           
            
            

          
            </li>
    
           
            
      
           
          
            
         
           

          
           
        </ul>
        <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>