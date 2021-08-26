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
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search.."> 
                    </div>
                </div>
                <div class="portlet-body">
                    
                        <div class="table-scrollable">
                            <div id="user_data" >
                                @include('Admin.Datacircle.Review.review_page')
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
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h4 class="modal-title">Assign Review</h4>
            </div>
            <form action=""  id="addTask" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Task Name</label>
                                    <input type="text" class="form-control" name="task_name" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Assigned To</label>
                                        <select class="form-control" name="member_id">
                                            <option value ="">Choose a Member</option>
                                        </select> 
                                    </div>
                                </div>
                            </div>
                          
                            <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Assigned Date</label>
                                    <input type="date" class="form-control" name="assigned_date" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>
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
                    url : "{{ route('admin.datacircle.review.getMoreReviews')}}"+"?page="+page,
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