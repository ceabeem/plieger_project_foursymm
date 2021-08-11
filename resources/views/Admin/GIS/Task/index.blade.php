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
            <span>Tasks</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Task's List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        <a href="#basic" data-toggle="modal" class="btn btn-sm green"><i class="fa fa-plus"></i> Add New Task</a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Task List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search.."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="user_data" >
                                @include('Admin.GIS.Task.task_page')
                            </div>
                            
                        </div>
                        
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

<!-- add slider modal -->
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="close-btn" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Add Task</h4>
            </div>
            <form action=""  id="addTask" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Task Name</label>
                                    <input type="text" class="form-control" name="task_name" maxlength = "50" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Assigned To</label>
                                        <select class="form-control" name="member_id" required>
                                            <option value ="">Choose a Member</option>
                                            @foreach($members as $member)
                                            <option value="<?php echo $member['id'];?>">{{$member['name']}}</option>
                                            @endforeach
                                            
                                           
                                       
                                        </select> 
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Assigned Date</label>
                                    <input type="date" class="form-control" name="assigned_date" oninput="" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" id="cancel-btn" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn green ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end of add slider modal -->
@endsection

@section ('page-scripts')
<script type="text/javascript">

document.getElementById("close-btn").addEventListener("click", function(){ 
   document.getElementById("addTask").reset();
});

document.getElementById("cancel-btn").addEventListener("click", function(){ 
   document.getElementById("addTask").reset();
});

function appendCommunityServices(tasks) {
            console.log(tasks);
            location.reload();
           
        }

        $("#addTask").on('submit', function(event) {
            event.preventDefault(); 
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: "task/store",
                type: 'POST',
                data: formData,
                success: function(res) {
                    if (res.status === 1) {
                        var tasks = res.tasks;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(tasks);
                        form[0].reset();
                        toastr.success('Task added successfully.');
                    }
                    if (res.nameexists === 1) {
                        toastr.error("Task name already exists. ");
                    }
                },
                error: function (request, status, errorThrown) {
                    aa=request.responseJSON;
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            if("The task name field is required."==itemx){
                                toastr.error("The task name field is required.");
                            }
                            if("The member id field is required."==itemx){
                                toastr.error("The member id field is required.");
                            }
                            
                        });
                        
                     });
                    
                    
                    //toastr.error('asdasdasd.');
                }
            });
        });

        function getallmembers()
        {
            var member_names = [];
            $.ajax({
                url: "{{route('gis.task.getallmembers')}}",
                type: 'GET',
                dataType: 'json',
                async:false,
                success: function(res) {
                    if (res.status === 1) {
                        member_names = res.member_names;
                    }
                }
            });

            return member_names;
        }


        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var member_names = getallmembers();
            var dialog = bootbox.dialog({
                    title: "Edit Team",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var taskID = e.closest('tr').attr('data-taskID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'task/' + taskID + '/edit';
                    
                    var task = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            task = res.task;
                        }
                    });
                    
                    var member_id = task.member_id;
                    var options = "";
                    options += '<option value="">Choose a Team</option>';
                    member_names.forEach(function(i, v) {
                        options += '<option value="'+i.id+'" '+((i.id == member_id)?"selected":'')+'>'+i.name+'</option>';
                    });
                    


                    var html = '<form action="" id="editTaskform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+task.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team name</label>'+
                                    '<input type="text" class="form-control" value="'+task.task_name+'" name="task_name" maxlength = "50" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Assigned TO</label>'+
                                    '<select class="form-control" name="member_id" value="" required>'+
                                    options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Assigned Date</label>'+
                                    '<input type="date" class="form-control" value="'+task.assigned_date+'" name="assigned_date" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                    '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>'+
                    '<input class="btn green" type="submit" value="Update">'+
                '</div>'+
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                }, 500);
            });
        });

        $(document).on('submit', '#editTaskform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "task/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var task = res.task;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(task);
                        toastr.success('Updated.');
                   }
                   if (res.nameexists === 1) {
                        toastr.error("Task name already exists. ");
                    }
               },
                error: function (request, status, errorThrown) {
                    aa=request.responseJSON;
                    console.log(aa);
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            if("The task name field is required."==itemx){
                                toastr.error("The task name field is required.");
                            }
                            if("The member id field is required."==itemx){
                                toastr.error("The member id field is required.");
                            }
                            
                        });
                        
                     });
                    
                    
                    //toastr.error('asdasdasd.');
                }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var taskID = e.closest('tr').attr('data-taskID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Team?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn green'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn red'
                    }
                },
                callback: function (result) {
                    if (result) {
                        var url = 'team/delete/'+taskID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Team has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });
        $(document).on('click', '.deltaskBtn', function(event) {
            var e = $(this);
            var item = e.closest('tr');
            var taskID = e.closest('tr').attr('data-taskID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Task?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn green'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn red'
                    }
                },
                callback: function (result) {
                    if (result) {
                        var url = 'task/delete/'+taskID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Task has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
            });
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
                url:'{{route("task.search")}}',
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
                            tableRow = '<tr><td>'+n+++'</td><td>'+value.task_name+'</td><td>'+value.assigned_member+'</td><td>'+value.team_name+'</td><td>'+value.assigned_date+'</td><td><a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn" ><i class="fa fa-edit"></i> Edit </a>';

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
                url : "{{ route('task.getMoreTasks')}}"+"?page="+page,
                data : {
                    'search_query' : search
                },
                success:function(data){
                    $('#user_data').html(data);
                }
            })
        }

    </script>
@endsection

