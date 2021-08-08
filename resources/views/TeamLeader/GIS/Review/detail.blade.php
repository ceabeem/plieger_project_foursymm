@extends ('layouts.teamleader_layout')

@section ('page-styles')
<!-- <link rel="stylesheet" href="{{ asset('assets/global/plugins/ekko-lightbox/ekko-lightbox.min.css') }}"> -->
@endsection

@section('content')
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/teamleader/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <i class="fa fa-circle"></i>
        <li>
            <span>Review</span>
        </li>
        <li>
            <span>$taskview->task_name</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Task Review List
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
                        <span class="caption-subject font-black sbold uppercase">Reviewed List</span>
                    </div>
                </div>
                <div class="portlet-body">
                    
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-advance table-hover" id="teamtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i>Review Assigned Member </th>
                                            <th>
                                            <i class="fa fa-user"></i>Review Assigned Date </th>
                                            <th>
                                            <i class="fa fa-clock"></i>Review Assigned Time </th>
                                            <th>
                                            <i class="fa fa-clock"></i>Review Finished Time </th>
                                            <th>
                                            <i class="fa fa-user"></i>Total Time Taken </th>
                                            
                                            
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($taskview as $view)
                                    <tr>
                                        <td>{{$no++}}</td>
                                        <td>{{$view['task_name']}}</td>
                                        <td>{{$view['review_assigned_member']}}</td>
                                        <td>{{$view['review_assigned_date']}}</td>
                                        <td>{{$view['review_assigned_time']}}</td>
                                        <td>{{$view['review_finished_time']}}</td>
                                        <td>{{$view['total_time_taken']}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection