<table class="table table-striped table-bordered table-advance table-hover" id="summarytable">
                                <thead>
                                    <tr><th>S.no</th>
                                    <th><i class="fa fa-user"></i> Name </th>
                                        <th>
                                            <i class="fa fa-calendar"> </i> Date</th>
                                            <th>
                                            <i class="fa fa-briefcase"> </i> Job Name</th>
                                            <th>
                                            <i class="fa fa-clock"> </i> Start Time</th>
                                            <th>
                                            <i class="fa fa-clock"> </i> End Time</th>
                                            <th>
                                            <i class="fa fa-calculator-alt"> </i> Time Taken</th>
                                            <th>
                                            <i class="fa fa-comments"> </i> Remark</th>
                                            
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($timesheets) && !empty($timesheets))
                                @foreach($timesheets as $timesheet)
                                    <tr data-timesheetID="<?php echo $timesheet['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$timesheet['users']['fname']}}</td>
                                        <td>{{$timesheet['date']}}</td>
                                        <td>{{$timesheet['job_name']}}</td>
                                        <td>{{$timesheet['start_time']}}</td>
                                        <td>{{$timesheet['end_time']}}</td>
                                        <td>{{$timesheet['time_taken']}}</td>
                                        <td>{{$timesheet['remark']}}</td>
                                    </tr>
                                    @endforeach    

                                        <tr>
                                            <td class= " " colspan="10" align="center">
                                            {{ $timesheets->links() }}   
                                            </td>
                                        </tr>
                                </tbody>
                                @elseif(!empty($timesheets) && !empty($search))
                                <tbody>
                                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>
                                </tbody>
                                @else
                                <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                                        No Timesheet added.
                                </div>
                                @endif
                            </table>