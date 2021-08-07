<table class="table table-striped table-bordered table-advance table-hover" id="reviewpendingtable">
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
                    @if(isset($feedbacks) && !empty($feedbacks))
                                  @foreach($feedbacks as $feedback)
                                    <tr data-pendingID="<?php echo $feedback['id'];?>">
                                        <td>{{ (($feedbacks->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                                        <td>{{$feedback['task_name']}}</td>
                                        <td>{{$feedback['assigned_member']}}</td>
                                        <td>{{$feedback['team_name']}}</td>
                                        <td>{{$feedback['assigned_date']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn" style="margin: 1%"><i class="fa fa-edit"></i> Assign Review </a>
                                        <a href="{{route('pending.view',$feedback['id'])}}" class="btn btn-outline btn-circle btn-sm purple "style="margin: 1%"><i class="fa fa-edit"></i>View</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple pliegerqueries"style="margin: 1%"><i class="fa fa-edit"></i>View Queries</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm green pliegerreview"style="margin: 1%"><i class="fa fa-edit"></i>View Plieger Feedback</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delBtn" style="margin: 1%"> <i class="fa fa-check"></i>Finished </a> 
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach<tr>
                                        <td class="feedback" colspan="6" align="center">
                                            {{ $feedbacks->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                                @elseif(!empty($feedbacks) && !empty($search))
                                <tbody>
                                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>
                                </tbody>
                                @else
                                <tbody>
                                    <tr>
                                        <td class= " " colspan="6" align="center">
                                            No Member added.
                                        </td>
                                    </tr>
                                </tbody>
                                
                                @endif
                            </table>