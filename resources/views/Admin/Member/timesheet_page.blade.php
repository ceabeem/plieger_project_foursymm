<table class="table table-striped table-bordered table-advance table-hover" id="teamtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-calendar"> </i> Date</th>
                                            <th>
                                            <i class="fa fa-tasks"> </i> Job Name</th>
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
                    