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
                    @if(isset($pendings) && !empty($pendings))
                                  @foreach($pendings as $pending)
                                    <tr data-pendingID="<?php echo $pending['id'];?>">
                                        <td>{{ (($pendings->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$pending['task_name']}}</td>
                                        <td>{{$pending['assigned_member']}}</td>
                                        <td>{{$pending['team_name']}}</td>
                                        <td>{{$pending['assigned_date']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn" style="margin: 1%"><i class="fa fa-edit"></i> Assign Review </a>
                                        <a href="{{route('pending.view',$pending['id'])}}" class="btn btn-outline btn-circle btn-sm purple "style="margin: 1%"><i class="fa fa-edit"></i>View</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm red delBtn" style="margin: 1%"> <i class="fa fa-check"></i>Finished </a> 
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm green pliegerreview" style="margin: 1%"> <i class="fa fa-repeat"></i>Send for Henk Review </a> 
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editissueBtn"style="margin: 1%"><i class="fa fa-exclamation"></i> Issue </a>  
                                           
                                                                        
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
                                            No Member added.
                                        </td>
                                    </tr>
                                </tbody>
                                
                                @endif
                            </table>