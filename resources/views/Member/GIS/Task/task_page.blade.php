<table class="table table-striped table-bordered table-advance table-hover" id="teamtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th><i class="fa fa-user"></i> Team Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Date </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody id="taskList">
                    @if(isset($tasks) && !empty($tasks))
                                    @foreach($tasks as $task)
                                    <tr data-taskID="<?php echo $task['id'];?>">
                                        <td>{{ (($tasks->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$task['task_name']}}</td>
                                        <td>{{$task['assigned_member']}}</td>
                                        <td>{{$task['team_name']}}</td>
                                        <td>{{$task['assigned_date']}}</td>
                                        <td>
                                            
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple delBtn"><i class="fa fa-edit"></i>Send for Review </a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-exclamation"></i> Issue </a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class= " " colspan="6" align="center">
                                            {{ $tasks->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                    @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Tasks added.
                    </div>
                @endif