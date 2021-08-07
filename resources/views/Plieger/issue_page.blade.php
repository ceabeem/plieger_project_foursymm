<table class="table table-striped table-bordered table-advance table-hover" id="reviewpendingtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-tasks"></i> Task Name</th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th><i class="fa fa-users"></i> Team Name </th>
                                            <th>
                                                <i class="fas fa-asterisk"></i> Issue Remark </th>
                                            <th><i class="fas fa-exclamation-triangle"></i>Priority</th>
                                            <th><i class="fas fa-exclamation-triangle"></i>Feedback Send</th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                    @if(isset($issues) && !empty($issues))
                                  @foreach($issues as $issue)
                                    <tr data-issueID="<?php echo $issue['id'];?>">
                                        <td>{{ (($issues->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$issue['task_name']}}</td>
                                        <td>{{$issue['assigned_member']}}</td>
                                        <td>{{$issue['team_name']}}</td>
                                        <td>{{$issue['issue_remark']}}</td>
                                        @if($issue['priority'] == 0)
                                            <td style="color:green">{{'Normal'}}</td>
                                        @elseif($issue['priority'] == 1)
                                            <td style="color:green">{{'Normal'}}</td>
                                        @elseif($issue['priority'] == 2)
                                            <td style="color:blue">{{'Important'}}</td>
                                        @elseif($issue['priority'] == 3)
                                            <td style="color:red">{{'Urgent'}}</td>
                                        @endif
                                        @if($issue['issue_feedback'])
                                            <td style="color:green;font-weight: bolder">{{'Yes'}}</td>
                                        @else
                                            <td>{{'No'}}</td>
                                        @endif
                                        <td class='issue-feedback' hidden><?php echo $issue['issue_feedback'];?></td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green delBtn" > <i class="fa fa-plus"></i>Update Feedback</a>                      
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class= " " colspan="7" align="center">
                                            {{ $issues->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Issues.
                    </div>
                @endif