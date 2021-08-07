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
            <span>Teams</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Review Pending List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        
    </div>
</div>
<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">File Send For Plieger Review</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search1"  id="search1" class="form-control pull-right " placeholder="Search .."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="user_data1" >
                            @include('Admin.Datacircle.PliegerReview.pending_page2')
                        </div> 
                        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Feedback From Plieger</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search .."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="user_data" >
                            @include('Admin.Datacircle.PliegerReview.pending_page')
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

function appendCommunityServices(pendings) {
            console.log(pendings);
            location.reload();
           
        }

        function getallmembers()
        {
            var member_names = [];
            $.ajax({
                url: "{{route('task.getallmembers')}}",
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
        $(document).on('click', '.pliegerreview', function(event) {
            var e = $(this);
            var member_names = getallmembers();
            var dialog = bootbox.dialog({
                    title: "Plieger Feedback",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var pendingID = e.closest('tr').attr('data-pendingID');
                    var rowIndex = e.closest('tr').index();
                    console.log(pendingID);
                    var url = 'pending/' + pendingID + '/feedback';
                    
                    var pending = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            pending = res.pending;
                        }
                    });
                    console.log(pending.feedback);
                    


                    var html = '<form action="">'+
                    '{{ csrf_field() }}'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Remarks</label>'+
                                    '<textarea required class="form-control"  disabled value="" name="issue_remark"  cols="30" rows="10" required>'+pending.feedback+'</textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+ 
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                    '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Ok</button>'
                '</div>'+
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                }, 500);
            });
        });
        $(document).on('click', '.pliegerqueries', function(event) {
            var e = $(this);
            var member_names = getallmembers();
            var dialog = bootbox.dialog({
                    title: "Queries",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var pendingID = e.closest('tr').attr('data-pendingID');
                    if(!pendingID){
                        var pendingID = e.closest('tr').attr('data-sendID');
                    }
                    console.log(pendingID);
                    var rowIndex = e.closest('tr').index();
                    var url = 'pending/' + pendingID + '/feedback';
                    
                    var pending = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            pending = res.pending;
                        }
                    });
                    // console.log(pending.feedback);
                    


                    var html = '<form action="">'+
                    '{{ csrf_field() }}'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<textarea required class="form-control"  disabled value="" name="issue_remark"  cols="30" rows="10" required>'+pending.queries+'</textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+ 
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                    '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Ok</button>'
                '</div>'+
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                }, 500);
            });
        });
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
                    var pendingID = e.closest('tr').attr('data-pendingID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'pending/' + pendingID + '/edit';
                    
                    var pending = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            pending = res.pending;
                        }
                    });
                    console.log(pending);
                    
                    var member_id = pending.member_id;
                    var options = "";
                    options += '<option value="">Choose a Team</option>';
                    member_names.forEach(function(i, v) {
                        options += '<option value="'+i.id+'" '+((i.id == member_id)?"selected":'')+'>'+i.name+'</option>';
                    });
                    


                    var html = '<form action="" id="editPendingform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+pending.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team name</label>'+
                                    '<input type="text" class="form-control" value="'+pending.task_name+'" name="task_name" readonly required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Assigned Review TO</label>'+
                                    '<select class="form-control" name="member_id" value="">'+
                                    options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Review Assigned Date</label>'+
                                    '<input type="date" class="form-control" value="'+pending.assigned_date+'" name="assigned_date" readonly required>'+
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
        $(document).on('submit', '#editPendingform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "pending/update2",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var pending = res.pending;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(pending);
                        toastr.success('Updated.');
                   }
               }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var pendingID = e.closest('tr').attr('data-pendingID');

            bootbox.confirm({
                message: "Do you want to finish this task?",
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
                        var url = 'pending/finish2/'+ pendingID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    location.reload();
                                    toastr.success('The Task has been Finished.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });
        $(document).on('click', '.editissueBtn', function(event) {
            var e = $(this);
            var dialog = bootbox.dialog({
                    title: "Edit Team",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var pendingID = e.closest('tr').attr('data-pendingID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'pending/' + pendingID + '/issueedit';
                    
                    var pending = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            pending = res.pending;
                        }
                    });
                    
                    
                  var html = '<form action="" id="editreviewform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+pending.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Remarks</label>'+
                                    '<textarea required class="form-control"  value="" name="issue_remark"  cols="30" rows="10" required>'+((pending.issue_remark == null)?"":pending.issue_remark)+'</textarea>'+
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

        $(document).on('submit', '#editreviewform', function(event) {
           event.preventDefault();
           var form = $(this);
           var formData = form.serialize();

           $.ajax({
               url: "pending/issueupdate",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var review = res.review;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(review);
                        toastr.success('Issue Updated.');
                   }
               }
           }); 
        });

        //search Pending
        $(document).ready(function(){
            $(document).on('click','.feedback .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMorePendings(page);
            });
            $(document).on('click','.send .pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMorePendings1(page);
            });

            $("#search1").on('keyup', function(){
                getMorePendings1(1);
            })
            $("#search").on('keyup', function(){
                getMorePendings(1);
            })
        });
        
        function getMorePendings1(page)
        {
            var search = $("#search1").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('reviewpending.getMorePliegerReview1')}}"+"?page="+page,
                data : {
                    'search_query' : search
                },
                success:function(data){
                    $('#user_data1').html(data);
                }
            })
        }
        function getMorePendings(page)
        {
            var search = $("#search").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('reviewpending.getMorePliegerReview2')}}"+"?page="+page,
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

