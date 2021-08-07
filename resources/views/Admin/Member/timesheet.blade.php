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
            <a href="{{ route('admin.member') }}">
            <span>Member</span>
            </a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Timesheet</span>
            </a>
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

<div class="container">
    <div class="row">
        <div class="col-md-11">
            <div class="portlet light portlet-fit bordered">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="icon-calendar font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Timesheet List</span>
                    </div>
                    <div class=" col-md-3 pull-right">
                        <input type="text" name="team_search"  id="search" class="form-control  " placeholder="Search Date.."> 
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                            <div id="user_data" >
                                @include('Admin.Member.timesheet_page')
                            </div>
                        </div>
        </div>
    </div>
</div>

<!-- add slider modal -->

@endsection
@section ('page-scripts')
<script type="text/javascript">
    $.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

     //Search Timesheet
     $(document).ready(function(){
            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                var pageURL = window.location.href;
                 var lastpart = pageURL.substr(pageURL.lastIndexOf('/') + 1);
                 var id = lastpart.split('?');
                 var page2 = $(this).attr('href').split('/member')[0];
                getMoreTimesheet(page,id[0]);
            });

            $("#search").on('keyup', function(){
                var pageURL = window.location.href;
                var lastpart = pageURL.substr(pageURL.lastIndexOf('/') + 1);
                var id = lastpart.split('?');

                getMoreTimesheet(1,id[0]);
            })
        });
        
        function getMoreTimesheet(page,id)
        {
            var search = $("#search").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('member.timesheet.getMoreTimesheet')}}",
                data : {
                    page:page,
                    search_query : search,
                    id_user: id
                },
                success:function(data){
                    $('#user_data').html(data);
                },error:function(xmlHttpRequest, textStatus, errorThrown){
                    alert(errThrown);
                }
            })
        }

</script>
@endsection
