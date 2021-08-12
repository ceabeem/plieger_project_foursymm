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
        <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" >
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
            <li class="nav-item <?php echo ((Request::routeIs('admin.dashboard'))? 'active': '') ?>">
                <a href="{{ route('admin.dashboard') }}" class="nav-link nav-toggle">
                    <i class="icon-home"></i>
                    <span class="title">Dashboard</span>
                    <span class="selected"></span>
                </a>
            </li>
           

            <li class="nav-item <?php echo ((Request::routeIs('admin.team'))? 'active': '') ?>">
                <a href="{{ route('admin.team') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Team</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('admin.workstatus'))? 'active': '') ?>">
                <a href="{{ route('admin.workstatus') }}" class="nav-link nav-toggle">
                    <i class="fa fa-users"></i>
                    <span class="title">Team Summary</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('admin.job'))? 'active': '') ?>">
                <a href="{{ route('admin.job') }}" class="nav-link nav-toggle">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">Job</span>
                    <span class="selected"></span>
                </a>
            </li>

            <li class="nav-item <?php echo ((Request::routeIs('admin.member'))? 'active': '') ?>">
                <a href="{{ route('admin.member') }}" class="nav-link nav-toggle">
                    <i class="fa fa-user-o"></i>
                    <span class="title">Member</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item 
                            <?php 
                                if((Request::routeIs('admin.tasksummary'))){
                                echo ((Request::routeIs('admin.tasksummary'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.task'))){
                                    echo ((Request::routeIs('admin.task'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.reviewpending'))){
                                    echo ((Request::routeIs('admin.reviewpending'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.pliegerreview'))){
                                    echo ((Request::routeIs('admin.pliegerreview'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.review'))){
                                    echo ((Request::routeIs('admin.review'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.finish'))){
                                    echo ((Request::routeIs('admin.finish'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.upload'))){
                                    echo ((Request::routeIs('admin.upload'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('admin.issue'))){
                                    echo ((Request::routeIs('admin.issue'))? 'start active open': '') ;
                                }
                            ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fas fa-database"></i>
                                    <span class="title">Data Enrichment</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu">
                                <li class="nav-item <?php echo ((Request::routeIs('admin.tasksummary'))? 'active': '') ?>">
                                        <a href="{{ route('admin.tasksummary') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-thumbtack"></i>
                                            <span class="title">Task Summary</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('admin.task'))? 'active': '') ?>">
                                        <a href="{{ route('admin.task') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-thumbtack"></i>
                                            <span class="title">Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('admin.reviewpending'))? 'active': '') ?>">
                                        <a href="{{ route('admin.reviewpending') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-repeat"></i>
                                            <span class="title">Final Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('admin.pliegerreview'))? 'active': '') ?>">
                                        <a href="{{ route('admin.pliegerreview') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-repeat"></i>
                                            <span class="title">Henk Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('admin.review'))? 'active': '') ?>">
                                        <a href="{{ route('admin.review') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-calendar-check-o"></i>
                                            <span class="title">TeamLeader Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('admin.finish'))? 'active': '') ?>">
                                        <a href="{{ route('admin.finish') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-tasks"></i>
                                            <span class="title">Finished Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('admin.upload'))? 'active': '') ?>">
                                        <a href="{{ route('admin.upload') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-upload"></i>
                                            <span class="title">Uploaded Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('admin.issue'))? 'active': '') ?>">
                                        <a href="{{ route('admin.issue') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span class="title">Issue's Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                
                                </ul>
            </li>
            <li class="nav-item 
                            <?php 
                                if((Request::routeIs('GIS.tasksummary'))){
                                echo ((Request::routeIs('GIS.tasksummary'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.task'))){
                                    echo ((Request::routeIs('GIS.task'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.reviewpending'))){
                                    echo ((Request::routeIs('GIS.reviewpending'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.pliegerreview'))){
                                    echo ((Request::routeIs('GIS.pliegerreview'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.review'))){
                                    echo ((Request::routeIs('GIS.review'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.finish'))){
                                    echo ((Request::routeIs('GIS.finish'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.upload'))){
                                    echo ((Request::routeIs('GIS.upload'))? 'start active open': '') ;
                                }
                                if((Request::routeIs('GIS.issue'))){
                                    echo ((Request::routeIs('GIS.issue'))? 'start active open': '') ;
                                }
                            ?>">
                                <a href="javascript:;" class="nav-link nav-toggle">
                                <i class="fas fa-database"></i>
                                    <span class="title">GS1</span>
                                    <span class="selected"></span>
                                    <span class="arrow open"></span>
                                </a>
                                <ul class="sub-menu">
                                <li class="nav-item <?php echo ((Request::routeIs('GIS.tasksummary'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.tasksummary') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-thumbtack"></i>
                                            <span class="title">Task Summary</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.task'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.task') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-thumbtack"></i>
                                            <span class="title">Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.reviewpending'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.reviewpending') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-repeat"></i>
                                            <span class="title">Final Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.pliegerreview'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.pliegerreview') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-repeat"></i>
                                            <span class="title">Henk Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.review'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.review') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-calendar-check-o"></i>
                                            <span class="title">TeamLeader Review</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.finish'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.finish') }}" class="nav-link nav-toggle">
                                            <i class="fa fa-tasks"></i>
                                            <span class="title">Finished Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.upload'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.upload') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-upload"></i>
                                            <span class="title">Uploaded Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>

                                    <li class="nav-item <?php echo ((Request::routeIs('GIS.issue'))? 'active': '') ?>">
                                        <a href="{{ route('GIS.issue') }}" class="nav-link nav-toggle">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            <span class="title">Issue's Task</span>
                                            <span class="selected"></span>
                                        </a>
                                    </li>
                                
                                </ul>
            </li>
           
            <li class="nav-item <?php echo ((Request::routeIs('admin.timesheet'))? 'active': '') ?>">
                <a href="{{ route('admin.timesheet') }}" class="nav-link nav-toggle">
                    <i class="fa fa-calendar"></i>
                    <span class="title">Timesheet</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('admin.timesheetsummary'))? 'active': '') ?>">
                <a href="{{ route('admin.timesheetsummary') }}" class="nav-link nav-toggle">
                    <i class="fa fa-calendar"></i>
                    <span class="title">Timesheet Summary</span>
                    <span class="selected"></span>
                </a>
            </li>
            <li class="nav-item <?php echo ((Request::routeIs('admin.export'))? 'active': '') ?>">
                <a href="{{ route('admin.export') }}" class="nav-link nav-toggle">
                    <i class="fas fa-cloud-download-alt"></i>
                    <span class="title">Export Timesheet</span>
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