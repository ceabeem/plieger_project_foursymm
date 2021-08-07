<table class="table table-striped table-bordered table-advance table-hover" id="reviewpendingtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-tasks"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th><i class="fa fa-users"></i> Team Name </th>
                                            <th>
                                            <i class="fas fa-calendar-week"></i> Assigned Date </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                    @if(isset($pendings) && !empty($pendings))
                                  @foreach($pendings as $pending)
                                    <tr data-pendingID="<?php echo $pending['id'];?>">
                                        <td>{{ (($pendings->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$pending['task_name']}}</td>
                                        <td>{{$pending['assigned_member']}}</td>
                                        <td>{{$pending['team_name']}}</td>
                                        <td>{{$pending['assigned_date']}}</td>
                                        <td>   
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm green viewqueries"style="margin: 1%"><i class="fas fa-question"></i>View Queries </a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editissueBtn"style="margin: 1%"><i class="fas fa-reply"></i>Send feedback </a>  
                                        </td>
                                    </tr>
                                    @endforeach<tr>
                                        <td class= " " colspan="6" align="center">
                                            {{ $pendings->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                                @elseif(!empty($pendings) && !empty($search))
                                <tbody>
                                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>
                                </tbody>
                                @else
                                <tbody>
                                    <tr>
                                        <td class= " " colspan="6" align="center">
                                            No Data Found.
                                        </td>
                                    </tr>
                                </tbody>
                                
                                @endif
                            </table>