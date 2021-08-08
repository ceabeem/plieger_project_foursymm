<table class="table table-striped table-bordered table-advance table-hover" id="reviewtable">
                                <thead>
                                    <tr><th> #S.no</th>
                                        <th>
                                            <i class="fa fa-user"></i> Task Name </th>
                                            <th>
                                            <i class="fa fa-user"></i> Assigned Member </th>
                                            <th>
                                            <i class="fa fa-user"></i> Team </th>
                                            <th><i class="fa fa-exclamation"></i> Action</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  @foreach($reviews as $review)
                                    <tr data-reviewID="<?php echo $review['id'];?>">
                                        <td>{{ (($reviews->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$review['task_name']}}</td>
                                        <td>{{$review['assigned_member']}}</td>
                                        <td>{{$review['team_name']}}</td>
                                        <td>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple delBtn"><i class="fa fa-edit"></i>Send for Review </a>
                                        <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-exclamation"></i> Issue </a>
                                            
                                           
                                                                        
                                        </td>
                                    </tr>
                                  @endforeach
                                  <tr >
                                    <td class= " " colspan="5" align="center">
                                        {{ $reviews->links() }}  
                                    </td>
                                </tr>
                                </tbody>
                            </table>