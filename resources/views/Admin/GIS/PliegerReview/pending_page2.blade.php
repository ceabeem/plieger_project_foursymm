<table class="table table-striped table-bordered table-advance table-hover" id="reviewsendtable2">
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
                    @if(isset($sends) && !empty($sends))
                                  @foreach($sends as $send)
                                    <tr data-sendID="<?php echo $send['id'];?>">
                                        <td>{{ (($sends->currentPage() * 10) - 10) + $loop->iteration  }}</td>
                                        <td>{{$send['task_name']}}</td>
                                        <td>{{$send['assigned_member']}}</td>
                                        <td>{{$send['team_name']}}</td>
                                        <td>{{$send['assigned_date']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple pliegerqueries"style="margin: 1%"><i class="fa fa-edit"></i>View Queries</a>
                                        </td>
                                    </tr>
                                    @endforeach<tr>
                                        <td class= "send" colspan="6" align="center">
                                            {{ $sends->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                                @elseif(!empty($sends) && !empty($search))
                                <tbody>
                                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>
                                </tbody>
                                @else
                                <tbody>
                                    <tr>
                                        <td class= "" colspan="6" align="center">
                                            No Member added.
                                        </td>
                                    </tr>
                                </tbody>
                                
                                @endif
                            </table>