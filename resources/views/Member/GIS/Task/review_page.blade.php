<table class="table table-striped table-bordered table-advance table-hover" id="reviewtable">
                                <thead>
                                    <tr><th>S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i>Review Assigned Member </th>
                                            <th>
                                            <i class="fa fa-user"></i>Team</th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                @if(count($reviews)>0)
                                <tbody>
                                  @foreach($reviews as $review)
                                    <tr data-reviewID="<?php echo $review['id'];?>">
                                        <td>{{ (($reviews->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$review['task_name']}}</td>
                                        <td>{{$review['review_assigned_member']}}</td>
                                        <td>{{$review['team_name']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple delBtn"><i class="fa fa-tick"></i>Finished Review</a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-exclamation"></i> Issue </a>  
                                           
                                                                        
                                        </td>
                                    </tr>
                                  @endforeach
                                  <tr >
                                    <td class= " " colspan="6" align="center">
                                        {{ $reviews->links() }}  
                                    </td>
                                </tr>
                            </tbody>
                            @else 
                            <tbody>
                                <tr>
                                    <td colspan="6" align="center"> Review Not Assigned </td>
                                </tr>
                            </tbody>
                            @endif  
                            </table>