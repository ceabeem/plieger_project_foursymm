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
            <span>Team Work Status</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Team Work Status List
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
                        <i class="icon-settings font-black"></i>
                        <span class="caption-subject font-black sbold uppercase">Team Work Status List</span>
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        @if(isset($work_status) && !empty($work_status))
                        <div id="user_data" >
                        <table class="table table-striped table-bordered table-advance table-hover" id="tasktable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-briefcase"></i> Member Name </th>
                                            <th>
                                            <i class="fa fa-users"></i> Team Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Position </th>
                                            <th>
                                            <i class="fa fa-user"></i>Total Assigned Task </th>
                                            <th>
                                            <i class="fa fa-user"></i> Total Reviewed Task </th>
                                            
                            
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    @foreach($work_status as $member)
                                        <tr data-memberID="<?php echo $member['id'];?>">
                                            <td>{{$no++}}</td>
                                            <td>{{$member['name']}}</td>
                                            <td>
                                            @php
                                                try {
                                                    print($member['teams']['team_name']);
                                                } catch (\Exception $e) {
                                                }
                                            @endphp
                                            </td>
                                            <td>
                                            @if($member['role_id'] == 1)
                                                            {{'Team Supervisor'}}
                                                        @elseif($member['role_id'] == 2)
                                                            {{'Team Leader'}}
                                                        @elseif($member['role_id'] == 3)
                                                            {{'Data Enrichment Member'}}
                                                        @elseif($member['role_id'] == 4)
                                                            {{'GI1 Member'}}
                                                        @elseif($member['role_id'] == 5)
                                                            {{'Data Enrichment and GI1 Menber'}}
                                                        @elseif($member['role_id'] == 6)
                                                            {{'Henk'}}
                                                        @else
                                                            {{'Member'}}
                                                        @endif
                                            </td>
                                            <td>{{$member['total_assigned_task']}}</td>
                                            <td>{{$member['reviewed_task']}}</td>
                                        </tr>
                                    @endforeach
                                        <tr>
                                            <td class= " " colspan="6" align="center">
                                        
                                                SuperVisor Reviewed = {{$reviews}}
                                            
                                            </td>
                                            
                                        </tr>
                                </tbody>
                                @elseif(!empty($tasks) && !empty($search))
                                <tbody>
                                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>
                                </tbody>
                                @else
                                <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                                        No Member added.
                                </div>
                                @endif
                            </table>
                            </div>
                            
                        </div>
                        
                    
                </div>
                
            </div>
        </div>
    </div>
</div>

@endsection

