<table class="table table-striped table-bordered table-advance table-hover" id="tasktable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-briefcase"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th><i class="fa fa-users"></i> Team Name </th>
                                            <th>
                                            <i class="fa fa-calendar"></i> Assigned Date </th>
                                            <th>
                                            <i class="fa fa-user"></i> Review Assigned Member </th>
                                            <th>
                                            <i class="fa fa-user"></i> Supervisor Review </th>
                                            <th>
                                            <i class="fa fa-tasks"></i> Finished </th>
                                            <th>
                                            <i class="fa fa-upload"></i> Uploaded </th>
                                            <th>
                                            <i class="fa fa-exclamation"></i> Issue </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($tasks) && !empty($tasks))
                                    @foreach($tasks as $task)
                                        <tr data-taskID="<?php echo $task['id'];?>">
                                            <td>{{ (($tasks->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                            <td>{{$task['task_name']}}</td>
                                            <td>{{$task['assigned_member']}}</td>
                                            <td>{{$task['team_name']}}</td>
                                            <td>{{$task['assigned_date']}}</td>
                                            <td>@if($task['status'] == 2 && $task['review_assigned_member'] != null)
                                            {{$task['review_assigned_member']}}
                                            @else
                                            {{'-'}}
                                            @endif</td>
                                            <td>@if($task['status'] == 3)
                                            {{'Reviewing By Supervisor'}}
                                            @else
                                            {{'-'}}
                                            @endif</td>
                                            <td>@if($task['status'] == 4)
                                            {{'Finished'}}
                                            @else
                                            {{'-'}}
                                            @endif</td>
                                            <td>@if($task['status'] == 5)
                                            {{'Uploaded'}}
                                            @else
                                            {{'-'}}
                                            @endif</td>
                                            <td>@if($task['status'] == 6)
                                            {{'Issues'}}
                                            @else
                                            {{'-'}}
                                            @endif</td>
                                            
                                           
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class= " " colspan="9" align="center">
                                                    {{ $tasks->links() }}    
                                            </td>
                                            <td rowspan="2">
                                                <a href="tasksummary/download"> <button type="button" class="btn btn-info" >Download</button></a>
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