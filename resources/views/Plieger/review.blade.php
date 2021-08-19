@extends ('layouts.plieger_layout')

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
                        <span class="caption-subject font-black sbold uppercase">Pending List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search Task Name.."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="user_data" >
                            @include('Plieger.pending_page')
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

        
        $(document).on('click', '.viewqueries', function(event) {
            var e = $(this);
            var dialog = bootbox.dialog({
                    title: "Queries",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var pendingID = e.closest('tr').attr('data-pendingID');
                    var rowIndex = e.closest('tr').index();
                    console.log(pendingID);
                    var url = 'queries/' + pendingID;
                    
                    var pending = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            pending = res.pending;
                        }
                    });
                    // console.log(pending);
                    


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
               },
                error: function (request, status, errorThrown) {
                    console.log(errorThrown);
                    aa=request.responseJSON;
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            console.log(itemx);
                            // if("The name field is required."==itemx){
                            //     toastr.error("The name field is required.");
                            // }
                        });
                        
                     });
                }
           }); 
        });

        //search Pending
        $(document).ready(function(){
            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMorePendings(page);
            });

            $("#search").on('keyup', function(){
                getMorePendings(1);
            })
        });
        
        function getMorePendings(page)
        {
            var search = $("#search").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('plieger.getMoreReview')}}"+"?page="+page,
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

