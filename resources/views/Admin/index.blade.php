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
<div class="btn-group" style="    margin: 25px 40px 5px 10px;
font-size: 17px;
float: right;
">
    <label for="project">Project: </label>

<select name="project" id="project">
  <option value="1">Data Circle</option>
  <option value="2">GIS</option>
</select>
  </div>
<div class="dashboard_data">
    @include('Admin.index_data_ajax')
</div>

<!-- <div class="clearfix"></div> -->
<!-- END DASHBOARD STATS 1-->
@endsection
@section ('page-scripts')
<script>
    var myChart ;
    function ChartInit(){
        var ctx = document.getElementById('canvas');
        myChart = new Chart(ctx, {
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
    }
    ChartInit();
    
    var start = moment().subtract(29, 'days').format('YYYY-MM-DD');
    var end = moment().format('YYYY-MM-DD');
    //console.log(start);
    //console.log(end);
    function loadChart(start,end){
        var url = "{{ route('showchart')}}";
        console.log('asd');
        $.ajax({
                url:url,
                data: {startd:start,endd:end,project_id:$('#project').val()},
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
    
    $('#project').change(function () {
        var project_id=$(this).val();
        console.log(project_id);
        $.ajax
        ({
            type : 'GET',
            url : "{{ route('admin.dashboard')}}",
            data : {
                'project_id' : project_id
            },
            success:function(data){
                $('.dashboard_data').html(data);
                start = moment().subtract(29, 'days').format('YYYY-MM-DD');
                end = moment().format('YYYY-MM-DD');
                ChartInit();
                loadChart(start,end);
                console.log(end);
            },
            error:function(data){
                console.log(data);
            }
        })       
    });
</script>
@endsection
