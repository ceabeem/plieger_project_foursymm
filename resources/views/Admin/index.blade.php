@extends('layouts.admin_layout')

@section('content')

<!-- BEGIN PAGE HEADER-->

<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        
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
            <div class="details">
                <div class="number">
                    <span data-counter="counterup" data-value="<?php echo $total_assigned_task ?>">0</span>
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
                    <span data-counter="counterup" data-value="<?php echo $remaining_task ?>">0</span></div>
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
                    <span data-counter="counterup" data-value="<?php echo $team_leader_review ?>">0</span>
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
                    <span data-counter="counterup" data-value="<?php echo $team_supervisor_review ?>">0</span>
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
                    <span data-counter="counterup" data-value="<?php echo $total_finished ?>">0</span>
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
                    <span data-counter="counterup" data-value="<?php echo $total_uploaded ?>">0</span></div>
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
                    <span data-counter="counterup" data-value="<?php echo $issues_remaining ?>">0</span></div>
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
                    <span data-counter="counterup" data-value="<?php echo $plieger_remaining ?>">0</span></div>
                <div class="desc"> Remaining Plieger Review </div>
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
                    <span data-counter="counterup" data-value="<?php echo $plieger_feedback ?>">0</span></div>
                <div class="desc">Plieger Feedback </div>
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
