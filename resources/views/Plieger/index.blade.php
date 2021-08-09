@extends('layouts.plieger_layout')

@section('content')

<!-- BEGIN PAGE HEADER-->

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
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
<!-- <div class="clearfix"></div> -->
<!-- END DASHBOARD STATS 1-->
@endsection
@section ('page-scripts')
<script>
        var ctx = document.getElementById('canvas');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [{
                    label: 'Total Assign',
                    data:[],
                    //backgroundColor: '#f000b0',
                    borderColor:'#f000b0',
                    borderWidth: 1
                },{
                    label: 'Assign Completed',
                    data: [],
                    borderColor:'#00c0ef',
                    borderWidth: 1
                },{
                    label: 'Reasssigned',
                    data: [],
                    borderColor:'#ff9100',
                    borderWidth: 1
                },{
                    label: 'Reviewed Completed',
                    data: [],
                    borderColor:'#03fc28',
                    borderWidth: 1
                },{
                    label: 'Issue',
                    data: [],
                    borderColor:'#f02222',
                    borderWidth: 1
                },{
                    label: 'Finished',
                    data: [],
                    borderColor:'#226af0',
                    borderWidth: 1
                }]

            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    
    var start = moment().subtract(29, 'days').format('YYYY-MM-DD');
    var end = moment().format('YYYY-MM-DD');
    //console.log(start);
    //console.log(end);
    function loadChart(start,end){
        var url = 'showchart';
        $.ajax({
                url:url,
                data: {startd:start,endd:end},
                type:'get',
                async:false,
                success:function(res) {   
                    myChart.data.labels=res.total;
                    myChart.data.datasets[0].data=res.assign;
                    myChart.data.datasets[0].label=res.ta;
                    myChart.data.datasets[1].data=res.assigncom;
                    myChart.data.datasets[1].label=res.tac;
                    myChart.data.datasets[2].data=res.reassign;
                    myChart.data.datasets[2].label=res.rac; 
                    myChart.data.datasets[3].data=res.reviewcom;
                    myChart.data.datasets[3].label=res.rc;
                    myChart.data.datasets[4].data=res.issue;
                    myChart.data.datasets[4].label=res.isc;
                    myChart.data.datasets[5].data=res.finish;
                    myChart.data.datasets[5].label=res.fin;          
                    myChart.update();
                },
                error: function (request, status, errorThrown) {
                        console.log(request.responseText);
                        //toastr.error('asdasdasd.');
                }
            });
    }
    loadChart(start,end);
    $('#dashboard-report-range').on('apply.daterangepicker', function(ev, picker) {
        var startDate = $('#dashboard-report-range').data('daterangepicker').startDate.format('YYYY-MM-DD');
        var endDate = $('#dashboard-report-range').data('daterangepicker').endDate.format('YYYY-MM-DD');
        //console.log(startDate);
        //console.log(endDate);
        loadChart(startDate,endDate);
    });
</script>
@endsection