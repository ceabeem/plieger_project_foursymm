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
            <a href="{{url('/teamleader/team')}}">Team</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Timesheet</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> {{$name}} Timesheet's List
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->


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

@endsection

