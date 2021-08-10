<h1 class="page-title"  > Welcome &nbsp;&nbsp;<i class="fa fa-circle" style="    font-size: 5px;"></i> 
    <small> &nbsp;&nbsp; {{($project_id==1)?'Data Circle':'GIS'}}</small>
</h1>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-tasks"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $total_assigned_task ?>">{{$total_assigned_task}}</span>
                </div>
                <div class="desc"> Total Assigned Task </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $remaining_task ?>">{{$remaining_task}}</span></div>
                <div class="desc"> Remaining Task </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-file-text"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $team_leader_review ?>">{{$team_leader_review}}</span>
                </div>
                <div class="desc">TeamLeader Reviewing Files </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-file-text"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $team_supervisor_review ?>">{{$team_supervisor_review}}</span>
                </div>
                <div class="desc">Supervisor Reviewing Files </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-file-text"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $total_finished ?>">{{$total_finished}}</span>
                </div>
                <div class="desc"> Total Finished </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 purple" href="#">
            <div class="visual">
                <i class="fa fa-upload"></i>
            </div>
            <div class="details">
                <div class="number"> 
                    <span data-counter="counterup" data-value="<?php echo $total_uploaded ?>">{{$total_uploaded}}</span></div>
                <div class="desc"> Total Uploaded </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-warning"></i>
            </div>
            <div class="details">
                <div class="number"> 
                    <span data-counter="counterup" data-value="<?php echo $issues_remaining ?>">{{$issues_remaining}}</span></div>
                <div class="desc"> Issues Task Remaining </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $plieger_remaining ?>">{{$plieger_remaining}}</span></div>
                <div class="desc"> Remaining Henk Review </div>
            </div>
        </a>
    </div> 
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $plieger_feedback ?>">{{$plieger_feedback}}</span></div>
                <div class="desc">Henk Feedback </div>
            </div>
        </a>
    </div>    
</div>
<div class="row">
    <div class="col-md-12 col-md-offset-0">
        <div class="panel panel-default">
            <div class="panel-heading"><b>Data Charts</b></div>
            <div class="panel-body">
                <canvas id="canvas" height="15" width="45"></canvas>
            </div>
        </div>
    </div>
</div>