<table class="table table-striped table-bordered table-advance table-hover" class="row margin-30" id="teamtable">
                           <thead>
                               <tr><th>S.no</th>
                                   <th>
                                       <i class="fa fa-user"></i> Team Name </th>
                                       <th><i class="fa fa-exclamation"></i> Action</th>
                                   
                               </tr>
                           </thead>

               
                                @if(isset($teams) && !empty($teams))
                                    @foreach($teams as $team)
                                <tbody>
                                    <tr data-teamID="<?php echo $team['id'];?>">
                                        <td>{{ (($teams->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$team['team_name']}}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>
                                            <a href="{{route('team.view',$team['id'])}}" class="btn btn-outline btn-circle btn-sm purple "><i class="fa fa-edit"></i>View</a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Delete</a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td align="center" colspan="5">
                                            {{ $teams->links() }}
                                        </td>
                                    </tr>
                                </tbody>
                    @elseif(!empty($teams) && !empty($search))
                    <tbody>
                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>

                    </tbody>
                    
                    @else
                    
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Teams Added
                    </div>
                    @endif     
</table>