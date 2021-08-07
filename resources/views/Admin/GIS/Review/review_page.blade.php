<table class="table table-striped table-bordered table-advance table-hover" id="reviewtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th>
                                            <i class="fa fa-user"></i>Team</th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                @if(isset($reviews) && !empty($reviews))
                                  @foreach($reviews as $review)
                                    <tr data-pendingID="<?php echo $review['id'];?>">
                                        <td>{{ (($reviews->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$review['task_name']}}</td>
                                        <td>{{$review['assigned_member']}}</td>
                                        <td>{{$review['team_name']}}</td>
                                        <td>
                                        <a href="{{route('pending.view',$review['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>
                                            
                                           
                                                                        
                                        </td>
                                    </tr>
                                  @endforeach
                                  <tr>
                                        <td class= " " colspan="6" align="center">
                                            {{ $reviews->links() }}  
                                        </td>
                                    </tr>
                                </tbody> 
                                @else
                                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                                        No Reviews Pending.
                                    </div>
                                @endif
                            </table>