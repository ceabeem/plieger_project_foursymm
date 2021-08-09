@extends('layouts.member_layout')

@section('content')

<!-- BEGIN PAGE HEADER-->

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Dashboard</span>
        </li>
    </ul>
    <div class="page-toolbar">
        <div id="dashboard-report-range" class="pull-right tooltips btn btn-sm" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
            <i class="icon-calendar"></i>&nbsp;
            <span class="thin uppercase hidden-xs"></span>&nbsp;
            <i class="fa fa-angle-down"></i>
        </div>
    </div>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Welcome
    <!-- <small>statistics, charts, recent events and reports</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 blue" href="#">
            <div class="visual">
                <i class="fa fa-tasks"></i>
            </div>
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $total_assigned_task_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $total_assigned_task_gis ?>">0</span>
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
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $remaining_task_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $remaining_task_gis ?>">0</span></div>
                <div class="desc"> Remaining Task </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-file-text"></i>
            </div>
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $team_leader_review_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $team_leader_review_gis ?>">0</span>
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
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $team_supervisor_review_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $team_supervisor_review_gis ?>">0</span>
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
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $total_finished_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $total_finished_gis ?>">0</span>
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
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $total_uploaded_dc ?>">0</span> 
                    <span data-counter="counterup" data-value="<?php echo $total_uploaded_gis ?>">0</span></div>
                <div class="desc"> Total Uploaded </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 red" href="#">
            <div class="visual">
                <i class="fa fa-warning"></i>
            </div>
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;"> 
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $issues_remaining_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $issues_remaining_gis ?>">0</span></div>
                <div class="desc"> Issues Task Remaining </div>
            </div>
        </a>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 yellow" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $plieger_remaining_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $plieger_remaining_gis ?>">0</span></div>
                <div class="desc"> Remaining Henk Review </div>
            </div>
        </a>
    </div> 
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <a class="dashboard-stat dashboard-stat-v2 green" href="#">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details" style="width: 60%">
                <div class="project" style="padding-top: 9px;text-align: right;font-size: 15px;color: white;"> 
                    <span style="float: left;">DataCircle</span>
                    <span>GIS</span>
                </div>
                <div class="number" style="padding-top: 10px;">
                    <span style="float: left;" data-counter="counterup" data-value="<?php echo $plieger_feedback_dc ?>">0</span>
                    <span data-counter="counterup" data-value="<?php echo $plieger_feedback_gis ?>">0</span></div>
                <div class="desc">Henk Feedback </div>
            </div>
        </a>
    </div>    
</div>
<!-- <div class="clearfix"></div> -->
<!-- END DASHBOARD STATS 1-->
@endsection