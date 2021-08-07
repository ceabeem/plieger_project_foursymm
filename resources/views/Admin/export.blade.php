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
            <span>Export TimeSheet</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">
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
                        <span class="caption-subject font-black sbold uppercase">Export TimeSheet</span>
                    </div>
                    
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable table-scrollable-borderless">
                        <div class="form-group">
                                <div id="dashboard-report-range" class="tooltips btn btn-md" style="padding-right: 30%" data-container="body" data-placement="bottom" data-original-title="Change dashboard date range">
                                    <i class="icon-calendar"></i>&nbsp;
                                    <span class="thin uppercase hidden-xs"></span>&nbsp;
                                    <i class="fa fa-angle-down"></i>
                                </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <select class="form-control" id=name>
                                    <option id='all'>All</option>
                                    @if(isset($names) && !empty($names))
                                        @foreach($names as $name)
                                            <option id='{{$name->id}}'>{{$name->name}}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-3">
                                <button type="button" class="btn btn-primary" id="export">Export</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- end of add slider modal -->
@endsection
@section ('page-scripts')
@if(session()->has('message'))
    <script type="text/javascript">
        toastr.success("{{ Session::get('message') }}");
    </script>
@endif
<script>
    $(document).ready(function(){
                var startd = moment().subtract(29, 'days');
                var endd = moment();
                $('#dashboard-report-range').data('daterangepicker').setStartDate(startd);
                $('#dashboard-report-range').data('daterangepicker').setEndDate(endd);
                $(document).on('click','#export', function(event){
                    var startDate = $('#dashboard-report-range').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var endDate = $('#dashboard-report-range').data('daterangepicker').endDate.format('YYYY-MM-DD');
                    //console.log(startDate);
                    var e = document.getElementById("name");
                    var userID = e.options[e.selectedIndex].id;
                    var user = e.options[e.selectedIndex].text;
                    //console.log(user);
                    window.location="download/"+userID+"/"+user+"/"+startDate+"/"+endDate;
                    /*$.ajax({
                        url: "download",
                        type: 'GET',
                        data: {'id':userID,
                                'start_date':startDate,
                                'end_date':endDate
                            },
                        success: function(res){
                            console.log(res.name);
                            if (res.status === 1) {
                               console.log("asda");
                            }
                        },
                        error: function (request, status, errorThrown) {
                            console.log(request.responseText);
                        }
                    });*/
                });

                
            });
</script>
@endsection