@extends ('layouts.admin_layout')

@section ('page-styles')
<!-- <link rel="stylesheet" href="{{ asset('assets/global/plugins/ekko-lightbox/ekko-lightbox.min.css') }}"> -->
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Timesheet Summary</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Timesheet's Summary List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-calendar font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Timesheet Summary List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search Date.."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="timesheetsummary_data" >
                        @include('Admin.Timesheet.timesheetsummary_page')
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section ('page-scripts')
<script type="text/javascript">

//Search Task
$(document).ready(function()
        {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }   
            });

            $('body').on('keyup','#search', function(){
                var searchValue = $(this).val();
            $.ajax({
                url:'{{route("timesheetsummary.search")}}',
                method: 'POST',
                data: {
                    searchValue: searchValue
                },
                dataType: 'json',
                success:function(res)
                {
                    var tableRow = '';
                    var n = 1;
                    if (res.status > 0) 
                    {
                        $('#tasklist').html('');

                        $.each(res.tableData, function(index, value){
                            tableRow = '<tr><td>'+n+++'</td><td>'+value.date+'</td>';

                            $('#tasklist').append(tableRow);
                        })
                    } else 
                    {
                        $('#tasklist').html('');
                        tableRow = '<tr><td align="center" colspan="5"> No Similar Values Found</td></tr>';  

                        $('#tasklist').append(tableRow);
                    }
                }
            })
            });
        });

        //Search Task
        $(document).ready(function(){
            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMoreTimesheets(page);
            });

            $("#search").on('keyup', function(){
                getMoreTimesheets(1);
            })
        });
        
        function getMoreTimesheets(page)
        {
            var search = $("#search").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('timesheetsummary.getMoreTimesheets')}}"+"?page="+page,
                data : {
                    'search_query' : search
                },
                success:function(data){
                    $('#timesheetsummary_data').html(data);
                }
            })
        }

    </script>
@endsection

