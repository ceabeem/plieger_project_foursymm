@extends ('layouts.teamleader_layout')

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
            <span>Timesheet</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Timesheet's List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        <a href="#basic" data-toggle="modal" class="btn btn-sm green"><i class="fa fa-plus"></i> Add New Timesheet</a>
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-calendar font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Timesheet List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    @if(isset($timesheets) && !empty($timesheets))
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="teamtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-calendar"> </i> Date</th>
                                            <th>
                                            <i class="fa fa-briefcase"> </i> Job Name </th>
                                            <th>
                                            <i class="fa fa-clock"> </i> Start Time</th>
                                            <th>
                                            <i class="fa fa-clock"> </i> End Time</th>
                                            <th>
                                            <i class="fa fa-calculator-alt"> </i> Time Taken</th>
                                            <th > 
                                            <i class="fa fa-comments"> </i> Remark</th>
                                            <th colspan = "2"><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($timesheets as $timesheet)
                                    <tr data-timesheetID="<?php echo $timesheet['id'];?>">
                                        <td>{{ (($timesheets->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$timesheet['date']}}</td>
                                        <td>{{$timesheet['job_name']}}</td>
                                        <td>{{$timesheet['start_time']}}</td>
                                        <td>{{$timesheet['end_time']}}</td>
                                        <td>{{$timesheet['time_taken']}}</td>
                                        <td>{{$timesheet['remark']}}</td>
                                        <td colspan="2">
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Delete</a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td align="center" colspan="7">
                                            {{$timesheets->links()}}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No timesheets added.
                    </div>
                @endif
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
                <h4 class="modal-title">Add Timesheet</h4>
            </div>
            <form action=""  id="addTimeSheet" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">
                    <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Date</label>
                                    <input type="date" class="form-control" name="date" onclick="" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Job</label>
                                        <select class="form-control" name="job_name" required >
                                            <option value ="">Choose a Job</option>
                                            @foreach($jobs as $job)
                                            <option value="<?php echo $job['job_name'];?>">{{$job['job_name']}}</option>
                                            @endforeach
                                       
                                        </select> 
                                    </div>
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Start Time</label>
                                    <input type="time" class="form-control" name="start_time" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">End Time</label>
                                    <input type="time" class="form-control" name="end_time" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Remark</label>
                                    <textarea required class="form-control"  value="" name="remark"  cols="30" rows="10" required></textarea>
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
   document.getElementById("addTimeSheet").reset();
});

document.getElementById("cancel-btn").addEventListener("click", function(){ 
   document.getElementById("addTimeSheet").reset();
});

function appendCommunityServices(timesheets) {
            console.log(timesheets);
            location.reload();
           
        }

        $("#addTimeSheet").on('submit', function(event) {
            event.preventDefault(); 
            var form = $(this);
            var formData = form.serialize();
            $.ajax({
                url: "timesheet/store",
                type: 'POST',
                data: formData,
                success: function(res) {
                    if (res.status === 1) {
                        var timesheets = res.timesheets;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(timesheets);
                        form[0].reset();
                        toastr.success('Timesheet added successfully.');
                    }
                },
                error: function (request, status, errorThrown) {
                    aa=request.responseJSON;
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            if("The date field is required."==itemx){
                                toastr.error("The date field is required.");
                            }
                            if("The job name field is required."==itemx){
                                toastr.error("The job name field is required.");
                            }
                            if("The start time field is required."==itemx){
                                toastr.error("The start time field is required.");
                            }
                            if("The end time field is required."==itemx){
                                toastr.error("The end time field is required.");
                            }
                            if("The remark field is required."==itemx){
                                toastr.error("The remark field is required.");
                            }
                            if("The date must be a date before tomorrow."==itemx){
                                toastr.error("Cant select future date.");
                            }
                        });
                        
                     });
                }
            });
        });

        function getjobs()
        {
            var jobs = [];
            $.ajax({
                url: "{{route('timesheet.getjobs')}}",
                type: 'GET',
                dataType: 'json',
                async:false,
                success: function(res) {
                    if (res.status === 1) {
                        jobs = res.jobs;
                    }
                }
            });

            return jobs;
        }




        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var jobs = getjobs();
            var dialog = bootbox.dialog({
                    title: "Edit Team",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var timesheetID = e.closest('tr').attr('data-timesheetID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'timesheet/' + timesheetID + '/edit';
                    
                    var timesheet = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            timesheet = res.timesheet;
                        }
                    });

                   
                    var job_name = timesheet.job_name;
                    var options = "";
                    options += '<option value="">Choose a Job</option>';
                    jobs.forEach(function(i, v) {
                        options += '<option value="'+i.job_name+'" '+((i.job_name == job_name)?"selected":'')+'>'+i.job_name+'</option>';
                    });
                    


                    var html = '<form action="" id="editTimesheetform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+timesheet.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Date</label>'+
                                    '<input type="date" class="form-control" value="'+timesheet.date+'" name="date" onclick="" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Job Name</label>'+
                                    '<select class="form-control" name="job_name" value="" required>'+
                                    options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Start Time</label>'+
                                    '<input type="time" class="form-control" value="'+timesheet.start_time+'" name="start_time" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">End Time</label>'+
                                    '<input type="time" class="form-control" value="'+timesheet.end_time+'" name="end_time" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Remark</label>'+
                                    '<textarea required class="form-control"  value="" name="remark"  cols="30" rows="10" required>'+timesheet.remark+'</textarea>'+
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

        $(document).on('submit', '#editTimesheetform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "timesheet/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       console.log(timesheet);
                       var timesheet = res.timesheet;
                    
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(timesheet);
                        toastr.success('Updated.');
                   }
               },
                error: function (request, status, errorThrown) {
                    aa=request.responseJSON;
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            if("The date field is required."==itemx){
                                toastr.error("The date field is required.");
                            }
                            if("The job name field is required."==itemx){
                                toastr.error("The job name field is required.");
                            }
                            if("The start time field is required."==itemx){
                                toastr.error("The start time field is required.");
                            }
                            if("The end time field is required."==itemx){
                                toastr.error("The end time field is required.");
                            }
                            if("The remark field is required."==itemx){
                                toastr.error("The remark field is required.");
                            }
                            if("The date must be a date before tomorrow."==itemx){
                                toastr.error("Cant select future date.");
                            }
                        });
                        
                     });
                }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var timesheetID = e.closest('tr').attr('data-timesheetID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Timesheet?",
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
                        var url = 'timesheet/delete/'+timesheetID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Timesheet has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '.viewBtn', function (event) {
        var e = $(this);
        var dialog = bootbox.dialog({
            title: "Team Members",
            message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
        });

        dialog.init(function () {
            setTimeout(function () {
                var teamID = e.closest('tr').attr('data-teamID');
                var rowIndex = e.closest('tr').index();
                var url = '/team/view/' + teamID;
                console.log(url)

                var member = "";
                $.ajax({
                    url: url,
                    type: 'get',
                    async: false,
                    success: function (res) {
                        member = res.member;
                    }
                });
                data = "";
                i = 0;
                member.forEach(element => {
                    i++;
                    data = data +'<tr><td>'+i+'</td><td>'+element.name+'</td></tr>';
                    // console.log(element)
                });




                var html = '<form action="" id="" class="horizontal-form" >' +
                    '{{ csrf_field() }}' +
                    '<div class="modal-body">' +
                    '<div class="form-body">' +
                    '<div class="row">' +
                    '<table class="table table-striped table-bordered table-advance table-hover">' +
                    '<thead>' +
                    '<tr><th>S.no</th>' +
                    '<th>Member Name</th>' +
                    '</tr>' +
                    '</thead>'+
                '<tbody>'+data+
                    '</tbody>'+
                '</table>'+
                '</div>' +
                '</div>' +
                '</div>' +
                '<div class="modal-footer">' +
                '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Close</button>' +
                '</div>' +
                '</form>';
                dialog.find('.bootbox-body').html(html);
            }, 500);
        });
    });

    

    </script>
@endsection

