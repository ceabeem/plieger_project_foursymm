<table class="table table-striped table-bordered table-advance table-hover" class="row margin-30" id="jobtable">
                           <thead>
                               <tr><th>S.no</th>
                                   <th>
                                       <i class="fa fa-user"></i> Job Name </th>
                                       <th><i class="fa fa-exclamation"></i> Action</th>
                                   
                               </tr>
                           </thead>

               
                                @if(isset($jobs) && !empty($jobs))
                                    @foreach($jobs as $job)
                                <tbody>
                                    <tr data-jobID="<?php echo $job['id'];?>">
                                        <td>{{ (($jobs->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                        <td>{{$job['job_name']}}</td>
                                        <td>
                                            <a href="javascript:;" class="btn btn-outline btn-circle btn-sm purple editBtn"><i class="fa fa-edit"></i> Edit </a>
                                            <a href="javascript:;" class="btn btn-outline btn-circle dark btn-sm black delBtn" > <i class="fa fa-trash-o"></i> Delete</a>
                                           
                                                                        
                                        </td>
                                    </tr>
                                    @endforeach

                                    <tr>
                                        <td align="center" colspan="5">
                                            {{ $jobs->links() }}
                                        </td>
                                    </tr>
                                </tbody>
                    @elseif(!empty($jobs) && !empty($search))
                    <tbody>
                    <tr><td align="center" colspan="5"> No Similar Values Found</td></tr>

                    </tbody>
                    
                    @else
                    
                    <div id="sliderContainer" class="col-md-12 empty_elem_tag">
                        No Jobs Added
                    </div>
                    @endif     
</table>