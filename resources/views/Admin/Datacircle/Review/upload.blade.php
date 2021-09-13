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
            <span>Uploaded Task</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Uploaded Task List
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
                        <span class="caption-subject font-black sbold uppercase">Uploaded List</span>
                    </div>
                    <div class="col-md-3 pull-right">
                        <input type="text" name="task_search"  id="search" class="form-control pull-right " placeholder="Search.."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="user_data" >
                                @include('Admin.Datacircle.Review.upload_page')
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
        

        $(document).ready(function(){
                $(document).on('click','.pagination a', function(event){
                    event.preventDefault();
                    var page = $(this).attr('href').split('page=')[1];
                    getMoreUpload(page);
                });

                $("#search").on('keyup', function(){
                    getMoreUpload(1);
                })
            });
            
            function getMoreUpload(page)
            {
                var search = $("#search").val();
                $.ajax
                ({
                    type : 'GET',
                    url : "{{ route('datacircle.upload.getMoreUpload')}}"+"?page="+page,
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
