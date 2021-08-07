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
                                            <th>
                                            <i class="fa fa-user"></i> Finished Date </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                    @if(isset($uploads) && !empty($uploads))
                                  @foreach($uploads as $upload)
                                    <tr data-uploadID="<?php echo $upload['id'];?>">
                                        <td>{{$no++}}</td>
                                        <td>{{$upload['task_name']}}</td>
                                        <td>{{$upload['assigned_member']}}</td>
                                        <td>{{$upload['team_name']}}</td>
                                        <td>{{$upload['assigned_date']}}</td>
                                        <td>{{$upload['finished_date']}}</td>
                                        <td>
                                        <a href="{{route('pending.view',$upload['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>                         
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td class= " " colspan="6" align="center">
                                            {{ $uploads->links() }}  
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            @else
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Task Pending.
                    </div>
                @endif