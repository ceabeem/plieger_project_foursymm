@extends ('layouts.admin_layout')

@section ('page-styles')
<!-- <link rel="stylesheet" href="{{ asset('assets/global/plugins/ekko-lightbox/ekko-lightbox.min.css') }}"> -->
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/admin/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Task Summary</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Task Summary List
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
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Task Summary List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search.."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="summary_data" >
                        @include('Admin.Datacircle.Task.tasksummary_page')
                       
                            </div>
                            
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
                url:'{{route("tasksummary.search")}}',
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
                        $('#taskList').html('');

                        $.each(res.tableData, function(index, value){
                            tableRow = '<tr><td>'+n+++'</td><td>'+value.task_name+'</td><td>'+value.assigned_member+'</td><td>'+value.team_name+'</td><td>'+value.assigned_date+'</td><td>yey</td>';

                            $('#taskList').append(tableRow);
                        })
                    } else 
                    {
                        $('#taskList').html('');
                        tableRow = '<tr><td align="center" colspan="5"> No Similar Values Found</td></tr>';  

                        $('#taskList').append(tableRow);
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
                getMoreTasks(page);
            });

            $("#search").on('keyup', function(){
                getMoreTasks(1);
            })
        });
        
        function getMoreTasks(page)
        {
            var search = $("#search").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('admin.datacircle.tasksummary.getMoreTasks')}}"+"?page="+page,
                data : {
                    'search_query' : search
                },
                success:function(data){
                    $('#summary_data').html(data);
                }
            })
        }

    </script>
@endsection



