<table class="table table-striped table-bordered table-advance table-hover" id="tasktable">
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
                                <tbody>
                            @if(isset($tasks) && !empty($tasks))
                                    @foreach($tasks as $task)
                                        <tr data-taskID="<?php echo $task['id'];?>">
                                            <td>{{ (($tasks->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                            <td>{{$task['task_name']}}</td>
                                            <td>{{$task['assigned_member']}}</td>
                                            <td>{{$task['team_name']}}</td>
                                            <td>{{$task['assigned_date']}}</td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>
                                                <a href="javascript:;" class="btn btn-outline btn-circle btn-sm red deltaskBtn"><i class="fa fa-trash"></i> Delete </a>
                                                
                                                                            
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td class= " " colspan="6" align="center">
                                                    {{ $tasks->links() }}  
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