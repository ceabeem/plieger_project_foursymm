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
        <li>
            <span> Team Members </span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Member's List
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
                        <span class="caption-subject font-black sbold uppercase"> Team Member List</span>
                    </div>
                </div>
                <div class="portlet-body">
                        <div class="table-scrollable">
                        <div id="user_data" >
                        <table class="table table-striped table-bordered table-advance table-hover" id="tasktable">
                        @if(isset($members) && !empty($members))
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Member Name </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                            
                                    @foreach($members as $member)
                                        <tr data-memberID="<?php echo $member['id'];?>">
                                            <td>{{$no++}}</td>
                                            <td>{{$member['name']}}</td>
                                            <td>
                                            <a href="{{route('teamleader.view',$member['id'])}}" class="btn btn-xs purple"> Timesheet </a>
                                            </td>
                                        </tr>
                                        @endforeach
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

