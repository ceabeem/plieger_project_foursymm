@extends ('layouts.admin_layout')

@section ('page-styles')
<!-- <link rel="stylesheet" href="{{ asset('assets/global/plugins/ekko-lightbox/ekko-lightbox.min.css') }}"> -->
@endsection

@section('content')

<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="{{url('/admin/dashboard')}}">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Members</span>
        </li>
    </ul>
    
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title">Members
    <!-- <small>front end banners</small> -->
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS 1-->

<div class="row margin-bottom-30">
    <div class="col-md-3 pull-right">
        <a href="#basic" data-toggle="modal" class="btn btn-sm green pull-right"><i class="fa fa-plus"></i> Add New Member</a>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet light portlet-fit bordered">
            <div class="portlet-title">
                <div class="caption">
                    <i class="icon-settings font-red"></i>
                    <span class="caption-subject font-red sbold uppercase">Member List</span>
                </div>
                <div class=" col-md-3 pull-right">
                    <input type="text" name="team_search"  id="search" class="form-control  " placeholder="Search.."> 
                </div>
            </div>
            <div class="portlet-body">
           
                <div class="table-scrollable table-scrollable-borderless">
                    <div id="user_data" >
                        @include('Admin.Member.member_page')
                    </div>
                    </div>
        </div>
    </div>
</div>
<!-- <div class="clearfix"></div> -->

<!-- add slider modal -->
<div class="modal fade" id="basic" tabindex="-1" role="basic" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" id="close-btn" aria-hidden="true"></button>
                <h4 class="modal-title">Add Member</h4>
            </div>
            <form action=""  id="addMember" class="horizontal-form">
                {{ csrf_field() }}
                <div class="modal-body">
                    <div class="form-body">

                    <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label class="control-label" id="image">Image</label>
                                    <input  name="file" type="file" id="imgInp"/>
                                    <div>
                                        <img id="cropimage" src=""  style="width: 300px,50%; height:300px; 100%; ">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Full Name</label>
                                    <input type="text" class="form-control" name="name" required>
                                </div>
                            </div>
                        </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Email</label>
                                    <input type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Password</label>
                                    <input type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Team</label>
                                        <select class="form-control" name="team_id" required>
                                            <option value ="">Choose a Team</option>
                                            @foreach($teams as $team)
                                            <option value="<?php echo $team['id'];?>">{{$team['team_name']}}</option>
                                            @endforeach
                                       
                                        </select> 
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                    <label class="control-label">Role</label>
                                        <select class="form-control" name="role_id" required>
                                            <option value ="">Choose a Role</option>
                                            <option value="1">Team Supervisor</option>
                                            <option value="2">Team Leader</option>
                                            <option value="3">Data Enrichment Member</option>
                                            <option value="4">GI1 Memeber</option>
                                            <option value="5">Data Enrichment & GI1 Member</option>
                                            <option value="6">Henk</option>
                                         </select> 
                                    </div>
                                </div>
                            </div>
                       
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Mobile No</label>
                                    <input type="text" class="form-control" name="mobile_no" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Address</label>
                                    <input type="text" class="form-control" name="address" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn dark btn-outline" id="cancel-btn" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn green ladda-button" data-style="expand-left"><span class="ladda-label">Submit</span></button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- end of add slider modal -->
@endsection

@section ('page-scripts')
<script type="text/javascript">
document.getElementById("close-btn").addEventListener("click", function(){ 
   document.getElementById("addMember").reset();
});

document.getElementById("cancel-btn").addEventListener("click", function(){ 
   document.getElementById("addMember").reset();
});
   
    $(function() {
        function appendCommunityServices(members) {
            console.log(members);
           location.reload();
        }
        function readURL(input) {

            if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function(e) {
                $('#cropimage').attr('src', e.target.result);
                cropper.destroy();
                initCrop();

            }

            reader.readAsDataURL(input.files[0]);
            }
        }

        function readEditUrl(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $("#editimage").attr('src', e.target.result);
                    edit_cropper.destroy();
                    initEditCrop();
                }
                reader.readAsDataURL(input.files[0]);    
            } 
        }

    $("#imgInp").change(function() {
        readURL(this);
    });

    $(document).on('change', '#editimg', function() {
        readEditUrl(this);
    });

        // $.ajaxSetup({
        //         headers: { 'X-CSRF-Token' : $('meta[name=csrf-token]').attr('content') }
        // });
        var image = "";
        var cropper = "";

        // variable for edit crop image.
        var edit_image = "";
        var edit_cropper = "";

        function initCrop() {
            image = document.getElementById('cropimage');
            cropper = new Cropper(image, {
            aspectRatio: 1 / 1,
            zoomOnWheel: false
                // crop(event) {
                //     console.log(event.detail.x);
                //     console.log(event.detail.y);
                //     console.log(event.detail.width);
                //     console.log(event.detail.height);
                //     console.log(event.detail.rotate);
                //     console.log(event.detail.scaleX);
                //     console.log(event.detail.scaleY);
                // },
            });
        }

        function initEditCrop() {
            edit_image = document.getElementById('editimage');
            edit_cropper = new Cropper(edit_image, {
                aspectRatio: 1 / 1,
                zoomOnWheel: false
            });
        }
       

        initCrop();

       

        $("#addMember").on('submit', function(event) {
            event.preventDefault();
            var form = $(this);
            var formData = new FormData(form[0]);
            if(document.getElementById("imgInp").value != "") {
                // you have a file
                cropper.crop();
                var crop_data = cropper.getData();
                formData.append('image_dimension', JSON.stringify(crop_data));
            }
            $.ajax({
                url: "member/store",
                type: 'POST',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function(res){
                    if (res.status === 1) {
                        var members = res.members;
                        form.closest('.modal').modal('hide');
                        appendCommunityServices(members);
                        form[0].reset();
                        toastr.success('Member added successfully.');
                    }
                    if (res.emailexists === 1) {
                        toastr.error('Email Address already Exists.');
                    }
                },
                error: function (request, status, errorThrown) {
                    aa=request.responseJSON;
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            if("The password format is invalid."==itemx){
                                toastr.error("Password must only Contain (alphabet+number) ");
                            }
                            if("The password must be at least 6 characters."==itemx){
                                toastr.error("The password must be at least 6 characters.");
                            }
                            if("The mobile no format is invalid."==itemx){
                                toastr.error("Mobile no format invalid. (ie.9xxxxxxxxx)");
                            }
                            if("The email must be a valid email address."==itemx){
                                toastr.error("Invalid Email Format");
                            }
                            if("The name field is required."==itemx){
                                toastr.error("The name field is required.");
                            }
                        });
                        
                     });
                }
            });
        });

        function getallteams()
        {
            var teamids = [];
            $.ajax({
                url: "{{route('member.getallteams')}}",
                type: 'GET',
                dataType: 'json',
                async:false,
                success: function(res) {
                    if (res.status === 1) {
                        teamids = res.teamids;
                    }
                }
            });

            return teamids;
        }


        // callback function for edition the client.
        $(document).on('click', '.editBtn', function(event) {
            var e = $(this);
            var teamids = getallteams();
            var dialog = bootbox.dialog({
                    title: "Edit Member",
                    message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
                }
            );

            dialog.init(function(){
                setTimeout(function(){
                    var memberID = e.closest('tr').attr('data-memberID');
                    var rowIndex = e.closest('tr').index();
                    var url = 'member/' + memberID + '/edit';
                    
                    var member = "";
                    $.ajax({
                        url:url,
                        type:'get',
                        async:false,
                        success:function(res) {
                            member = res.member;
                        }
                    });

                    var team_id = member.team_id;
                    var options = "";
                    options += '<option value="">Choose a Team</option>';
                    teamids.forEach(function(i, v) {
                        options += '<option value="'+i.id+'" '+((i.id == team_id)?"selected":'')+'>'+i.team_name+'</option>';
                    });
                    
                    var role_id =member.role_id;
                    var role_options = "";
                    role_options += '<option value="">Choose a Role</option>';
                    role_options += '<option value="1" '+((1 == role_id)?"selected":'')+'>Team Supervisor</option>';
                    role_options += '<option value="2" '+((2 == role_id)?"selected":'')+'>Team Leader</option>';
                    role_options += '<option value="3" '+((3 == role_id)?"selected":'')+'>Datacircle Member</option>';
                    role_options += '<option value="4" '+((4 == role_id)?"selected":'')+'>GIS Member</option>';
                    role_options += '<option value="4" '+((5 == role_id)?"selected":'')+'>Datacircle & GIS Member</option>';
                   

                    if(member.image_name==='no_image'){
                        var image_url = "<?php echo asset('/') . '/storage/Members/no_image.png'; ?>"
                    }else{
                        var image_url = "<?php echo asset('/') . '/storage/Members/'; ?>" +
                        member.id + "/" + member.image_name;
                    }
                    var html = '<form action="" id="editMemberform" class="horizontal-form" data-rowIndex="'+rowIndex+'">'+
                    '{{ csrf_field() }}'+
                        '<input type="hidden" value="'+member.id+'" name="id">'+
                        '<div class="modal-body">'+
                    '<div class="form-body">'+
                    '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Image</label>'+
                                    '<input  name="file" type="file" id="editimg" />'+
                                    '<div>'+
                                        '<img id="editimage" src="'+image_url+'"  style="width: 100%; height: auto;">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+   
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Full Name</label>'+
                                    '<input type="text" class="form-control" value="'+member.name+'" name="name" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Email</label>'+
                                    '<input type="email" class="form-control" value="'+member.email+'" name="email" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Team</label>'+
                                    '<select class="form-control" name="team_id" value="" required>'+
                                    options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Role</label>'+
                                    '<select class="form-control" name="role_id" value="" required>'+
                                    role_options+

                                    '</select>'+
                                   
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Mobile </label>'+
                                    '<input type="text" class="form-control" value="'+member.mobile_no+'" name="mobile_no" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label class="control-label">Address</label>'+
                                    '<input type="address" class="form-control" value="'+member.address+'" name="address" required>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="modal-footer">'+
                    '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>'+
                    '<input class="btn green" type="submit" value="Update">'+
                '</div>'+
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                    tinymce.remove("#model-editor");
                    tinymce.init({
                        selector: '#model-editor'
                    });

                    initEditCrop();
                }, 500);
            });
        });

        $(document).on('submit', '#editMemberform', function(event) {
           event.preventDefault();
           var form = $(this);
           edit_cropper.crop();

           var crop_data = edit_cropper.getData();
           var formData = new FormData(form[0]);
           formData.append('image_dimension', JSON.stringify(crop_data));

           $.ajax({
               url: "member/update",
               type: 'POST',
               data: formData,
               cache: false,
                contentType: false,
                processData: false,
               success: function(res) {
                   if (res.status === 1) {
                       var member = res.member;

                        form.closest('.modal').modal('hide');
                        appendCommunityServices(member);
                        toastr.success('Updated.');
                   }
               },
                error: function (request, status, errorThrown) {
                    aa=request.responseJSON;
                    jQuery.each(aa, function(index, item) {
                        jQuery.each(item, function(indexx, itemx) {
                            if("The mobile no format is invalid."==itemx){
                                toastr.error("Mobile no format invalid. (ie.9xxxxxxxxx)");
                            }
                            if("The email must be a valid email address."==itemx){
                                toastr.error("Invalid Email Format");
                            }
                            if("The name field is required."==itemx){
                                toastr.error("The name field is required.");
                            }
                        });
                        
                     });
                }
           }); 
        });

        $(document).on('click', '.delBtn', function(event) {

            var e = $(this);
            var item = e.closest('tr');
            var memberID = e.closest('tr').attr('data-memberID');

            bootbox.confirm({
                message: "Are you sure you want to delete this Member?",
                buttons: {
                    confirm: {
                        label: 'Yes',
                        className: 'btn green'
                    },
                    cancel: {
                        label: 'No',
                        className: 'btn red'
                    }
                },
                callback: function (result) {
                    if (result) {
                        var url = 'member/delete/'+memberID;

                        $.ajax({
                            url: url,
                            type: 'get',
                            async: false,
                            success: function(res) {
                                if (res.status === 1) {
                                    item.remove();
                                    toastr.success('The Member has been deleted.');
                                } else {
                                    toastr.error('Something went wrong. Please try again.');
                                }
                            }
                        });
                    }
                }
            });
        });

        $(document).on('click', '.detailbtn', function (event) {
            var e = $(this);
            var teamids = getallteams();
            var dialog = bootbox.dialog({
                title: "Detail",
                message: '<p><i class="fa fa-spin fa-spinner"></i> Loading...</p>',
            });

            dialog.init(function () {
                setTimeout(function () {
                    var memberID = e.closest('tr').attr('data-memberID');
                    var url = 'member/' + memberID + '/edit';

                    var member = "";
                    $.ajax({
                        url: url,
                        type: 'get',
                        async: false,
                        success: function (res) {
                            member = res.member;
                        }
                    });
                    
                    index = teamids.findIndex(x => x.id ===parseInt(member.team_id));
                    if(member.role_id===1){
                        rolename="Team Supervisor"
                    }else{
                        rolename="Team Member"
                    }
                    teamname=teamids[index]['team_name'];
                    if(member.image_name==='no_image'){
                        var image_url = "<?php echo asset('/') . '/storage/Members/no_image.png'; ?>"
                    }else{
                        var image_url = "<?php echo asset('/') . '/storage/Members/'; ?>" +
                        member.id + "/" + member.image_name;
                    }
                    

                    var html =
                        '<form action="" id="" class="horizontal-form"' +
                        '{{ csrf_field() }}' +
                        '<div class="modal-body">' +
                        '<div class="form-body">' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                                           
                        '<div>' +
                        '<img  src="' + image_url +
                        '"  style="width: 100%; height: auto;">' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Full Name</label>' +
                        '<input type="text" class="form-control" value="'+ member
                        .name + '" name="name" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Email</label>' +
                        '<input type="text" class="form-control" value="'+ member
                        .email + '" name="name" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +

                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Team</label>' +
                        '<input type="text" class="form-control" value="' + teamname + '"  required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Role</label>' +
                        '<input type="text" class="form-control" value="' + rolename + '"  required readonly>' +

                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Phone No.</label>' +
                        '<input type="text" class="form-control" value="' + member
                        .mobile_no + '" name="mobile_no" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="row">' +
                        '<div class="col-md-12">' +
                        '<div class="form-group">' +
                        '<label class="control-label">Address</label>' +
                        '<input type="address" class="form-control" value="' + member
                        .address + '" name="address" required readonly>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '</div>' +
                        '<div class="modal-footer">' +
                        '<button type="button" class="btn dark btn-outline" data-dismiss="modal">Cancel</button>' +
                        '</div>' +
                        '</form>';
                    dialog.find('.bootbox-body').html(html);
                    tinymce.remove("#model-editor");
                    tinymce.init({
                        selector: '#model-editor'
                    });

                }, 500);
            });
        });

    });

    //Search Member
    $(document).ready(function(){
            $(document).on('click','.pagination a', function(event){
                event.preventDefault();
                var page = $(this).attr('href').split('page=')[1];
                getMoreMembers(page);
            });

            $("#search").on('keyup', function(){
                getMoreMembers(1);
            })
        });
        
        function getMoreMembers(page)
        {
            var search = $("#search").val();
            $.ajax
            ({
                type : 'GET',
                url : "{{ route('member.getMoreMembers')}}"+"?page="+page,
                data : {
                    'search_query' : search
                },
                success:function(data){
                    console.log(data);
                    $('#user_data').html(data);
                }
            })
        }

    </script>
@endsection
