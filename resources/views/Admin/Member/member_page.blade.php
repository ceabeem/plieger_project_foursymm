
                    <table id="membertable" class="table table-hover table-light">
                        <thead>
                            <tr class="uppercase">
                                <th> SN </th>
                                <th> Full Name </th>
                               
                                <th> Action </th>
                            </tr>
                        </thead>
                        <tbody>
                        @if(isset($members) && !empty($members))
                      @foreach($members as $member)    
                            <tr data-memberID="<?php echo $member['id'];?>">
                                <td>{{ (($members->currentPage() * 20) - 20) + $loop->iteration  }}</td>
                                <td>{{$member['name']}}</td>
                              
                                <td>
                                    <a href="javascript:;" class="btn btn-xs red delBtn">delete</a>
                                    <a href="javascript:;" class="btn btn-xs blue editBtn">edit</a>
                                    <a href="{{route('member.view',$member['id'])}}" class="btn btn-xs green">View</a>
                                    <a href="{{route('member.timesheets',$member['id'])}}" class="btn btn-xs purple">Timesheet</a>
                                </td>
                                
                            </tr>
                          @endforeach
                        <tr>
                            <td align="center" colspan="5">
                                {{$members->links()}}
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                @else
        <div id="sliderContainer" class="col-md-12 empty_elem_tag">
            No Member added.
        </div>
    @endif
            