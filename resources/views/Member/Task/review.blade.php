@extends ('layouts.member_layout')

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
            <span>Review</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Review List
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
                        <span class="caption-subject font-black sbold uppercase">Review List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="search"  id="search" class="form-control pull-right " placeholder="Search.."> 
                    </div>
                </div>
                <div class="portlet-body">
                    
                        <div class="table-scrollable">
                            <div id="user_data" >
                                @include('Member.Task.review_page')
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
function appendCommunityServices(reviews) {
            console.log(reviews);
            location.reload();
           
        }


$(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var dialog = bootbox.dialog({
                    title: "Edit Team",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var reviewID = e.closest('tr').attr('data-reviewID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'review/' + reviewID + '/edit';
                    
                    var task = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            review = res.review;
                        }
                    });
                    
                    
                  var html = '<form action="" id="editreviewform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+review.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+  
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Remarks</label>'+
                                    '<textarea required class="form-control"  value="" name="issue_remark"  cols="30" rows="10" required>'+((review.issue_remark == null)?"":review.issue_remark)+'</textarea>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+ 
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                    '<select class="form-control" style="margin-bottom:3%" name="priority" required>'+
                            '<option value ="">Priority</option>'+
                                            '<option value="1">Normal</option>'+
                                            '<option value="2">Important</option>'+
                                            '<option value="3">Urgent</option>'+
                                         '</select> '+
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
               url: "review/update",
               type: 'POST',
               data: formData,
               success: function(res) {
                   if (res.status === 1) {
                       var review = res.review;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(review);
                        toastr.success('Updated.');
                   }
               }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var reviewID = e.closest('tr').attr('data-reviewID');

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
                        var url = 'task/reviewed/'+reviewID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Task has been Reviewd.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });

        $(document).ready(function(){
                $(document).on('click','.pagination a', function(event){
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    getMoreReviews(page);
                });

                $("#search").on('keyup', function(){
                    getMoreReviews(1);
                })
            });
            
            function getMoreReviews(page)
            {
                var search = $("#search").val();
                $.ajax
                ({
                    type : 'GET',
                    url : "{{ route('member.review.getMoreReviews')}}"+"?page="+page,
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

