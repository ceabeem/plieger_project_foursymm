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
                    @if(isset($finishs) && !empty($finishs))
                                  @foreach($finishs as $finish)
                                    <tr data-finishID="<?php echo $finish['id'];?>">
                                        <td>{{ (($finishs->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$finish['task_name']}}</td>
                                        <td>{{$finish['assigned_member']}}</td>
                                        <td>{{$finish['team_name']}}</td>
                                        <td>{{$finish['assigned_date']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i>Re-Assign Review </a>
                                        <a href="{{route('pending.view',$finish['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-check"></i>Upload </a>   
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class= " " colspan="6" align="center">
                                            {{ $finishs->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Reviews Pending.
                    </div>
                @endif