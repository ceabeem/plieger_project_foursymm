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
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Assign Review </a>
                                        <a href="{{route('teamleader.view1',$pending['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editissueBtn"><i class="fa fa-exclamation"></i> Issue </a>  
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr >
                                    <td class= " " colspan="6" align="center">
                                        {{ $pendings->links() }}  
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Reviews Pending.
                    </div>
                @endif