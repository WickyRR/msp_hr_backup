
@extends('layouts.app', ['page' => __('Members'), 'pageSlug' => 'applicants.view'])

@section('content')
    @push('pageSpecificCSS')
        <!-- table -->
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
        <link href="{{ asset('black') }}/css/custom/member-model.css" rel="stylesheet" />

    @endpush

    <div>
    <form  style="width:250px" method="get" >
    {{ csrf_field() }}
        <input  type="hidden" id="id" name="id">
        <select id="process" class="form-control input-lg dynamic" name="process" >
           <option value="">Select a Recruit Process</option>
           @foreach ($processes as $process)
           <option class="option" style="color:black" value="{{$process->recruit_process_id}}">{{$process->process_name}}</option>
           @endforeach
        </select>
        <button type="submit" onchange="filter({{$process->recruit_process_id}})" class="btn btn-primary btn-sm">Filter By</button>
    </form>
    </div>


    <div id="toolbar" class="row d-flex justify-content-end">
        <div class="col-sm">
                <button type="button" class="btn btn-primary btn-simple btn-sm" >
                    <a href="/applicants/{{$process->recruit_process_id}}/download"> <i class="tim-icons icon-cloud-download-93"></i> Export CSV </a>

                </button>

        </div>
        <button class="btn btn-primary btn-sm delete-all"><i class="fa fa-trash"></i>  Delete</button>
    </div>

     <div id="notifdev"></div>
    <div >
        <div class="card">
           @if(Session::has('status'))
             <div class="alert alert-success" role="alert">
                {{Session::get('status')}}
             </div>
           @endif
        </div>
        <table
        id="table"
        data-toolbar="#toolbar"
        class="table table-striped table-dark"
        data-toggle="table"
        data-search="true"
        data-search-on-enter-key="true"
        data-show-search-button="true"
        data-show-refresh="true"
        data-show-toggle="true"
        data-show-fullscreen="true"
        data-buttons-class="primary"
        data-buttons-prefix="btn-sm btn"
        data-click-to-select="true"
        data-search-highlight="true"
        >

        <thead>
        <tr>
            <th><input type="checkbox" id="check_all"></th>
            <th data-width="290px">Name</th>
            <th data-width="300px">Faculty</th>
            <th data-width="220px">Department</th>
            <th data-width="30px">Batch</th>
            <th data-width="60px">Is Active</th>
            <th >Operations</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($users as $value)
        <tr id="tr_{{$value->recruit_id}}" >
            <td><input type="checkbox" class="checkbox" name="ids" data-id="{{$value->recruit_id}}"></td>
            <td class="name">{{$value->name}}</td>
            <td>{{$value->fac_name}}</td>
            <td>{{$value->department}}</td>
            <td>{{$value->batch}}</td>
            @if($value->apply_status ==0)
                    <td>Applied</td>
            @elseif($value->apply_status ==1)
                    <td>Rejected</td>
            @else
                    <td>Recruited</td>
            @endif
            <td>
                <a  href="javascript:void(0)" data-id='{{ $value->recruit_id }}'  class="dltbtn">
                <i class="fa fa-trash"></i>   Delete</a>
                <a style="margin-left:20px"  href="javascript:void(0)"  onclick="edit({{ $value->recruit_id }})" >
                <i class="fa fa-edit"></i>   Update</a>

            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    </div>


    <!-- delete confirmation popup -->
    <div class="modal modal-danger " id="deletepopup" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog "  role="dialog" >
            <div class="modal-content" style="background-color:white">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><b>Delete Confirmation<b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <form  id="delete_modal_form" method="POST">
                    {{ csrf_field() }}
                    {{  method_field('GET') }}
                        <div class="modal-body">
                            <input  type="hidden" id="delete_applicants">
                            <h5 style="color:black">Are You sure,You want to delete this applicant?</h5>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">No,Cancel.</button>
                            <button type="submit" class="btn btn-primary" >Yes,Delete it.</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end of deletepopup modal -->

    <!-- Update Popup -->
    <div class="modal" id="updatepopup" tabindex="-1" role="dialog" aria-hidden="true">
       <div class="modal-dialog" role="document">
            <div class="modal-content" >
                <div class="modal-header">
                    <h5 class="modal-title" ><b>Update Applicants Details<b></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body" >
                    <form id="editform">
                            {{ csrf_field() }}
                            <input  type="hidden" id="edit_applicants" name="cid">
                            <div class="form-group">
                                <label for="a_name" >Name</label>
                                <input type="text" class="form-control"
                                id="a_name" name="a_name"  required >
                            </div>

                            <div class="form-group">
                            <label for="a_faculty" >Faculty</label><br/>
                            <select id="a_faculty" name="a_faculty" class="form-control" >
                            @foreach ($facs as $process)
                            <option class="option" style="color:black" value="{{$process->fac_id}}">{{$process->fac_name}}</option>
                            @endforeach

                            </select>
                            </div>

                            <div class="form-group">
                            <label for="a_department" >Departmemt</label>
                            <input type="text" class="form-control"
                            id="a_department" name="a_department" required >
                            </div>

                            <div class="form-group">
                            <label for="a_level" >Batch</label>
                            <input type="text" class="form-control"
                            id="a_level" name="a_level" required >
                            </div>

                            <div class="form-group">
                            <label for="a_status">Apply Status</label>
                            <select name="a_status" id="a_status" class="form-control" >
                               <option value="1" style="color: black;">Rejected</option>
                               <option value="0"  style="color: black;">Applied</option>
                               <option value="2" style="color: black;">Recruited</option>
                            </select>
                            </div>

                            <button type="submit" class="btn btn-primary">Submit</button>
                            <span id="error-message" class="test-danger"></span>
                            <span id="success_message" class="test-success"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- end of updatepopup modal -->



    @push('pageSpecificJS')
        <script src="{{asset('black/js/custom/recruits-dashboard.js')}}"></script>
        <script src="{{asset('js/alert-box.js')}}"></script>
        <!-- table -->
        <script src="https://unpkg.com/tableexport.jquery.plugin/tableExport.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <!-- Checkbox -->
        <script src="https://code.jquery.com/jquery-3.6.0.js"
        integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js"></script>
	    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js"></script>

        <script>
        //deleting selected applicants

        $(document).ready(function(){
            //selecting all at once
            $('#check_all').on('click',function(){
                if($(this).is(":checked",true)){
                    $('.checkbox').prop('checked',true);
                }else {
                    $('.checkbox').prop('checked',false);
                }
            });

            //enabaling select all if all rows are checked
            $('.checkbox').on('click',function(){
                if($('.checkbox:checked').length==$('.checkbox').length){
                    $('#check_all').prop('checked',true);
                }else {
                    $('#check_all').prop('checked',false);
                }
            });

            //delete all button
            $('.delete-all').on('click',function(e){
                var idsArray=[];

                $('.checkbox:checked').each(function(){
                    idsArray.push($(this).attr('data-id'));
                });

                if(idsArray.length<=0){
                    $('#notifdev').fadeIn();
                    $('#notifdev').text("Please select atleast one row");

                } else{
                    if(confirm("Are you sure You want to delete these rows")){
                        var strIds = idsArray.join(",");

                        $.ajax({
                           url:"{{route('users.multiple-delete')}}",
                           type:'DELETE',
                           headers:{'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')},
                           data: 'ids='+strIds,
                           success : function(data) {
                               if(data['status'== true]){
                                $('.checkbox:checked').each(function(){
                                    $(this).parents("tr").remove();
                                });
                               }
                           },
                       });
                    }
                }
            });

        });
        </script>


        <script>
        //deleting an applicant
         $(document).ready(function(){

             $('#table').on('click','.dltbtn',function(){
                 $dataid= $(this).data("id");

                 $('#delete_applicants').val($dataid);
                 $('#delete_modal_form').attr('action','/delete/'+ $dataid);
                 $('#deletepopup').modal('show');
             });
         });
        </script>

        <script>
        //updating an applicant
        function edit(id){
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('applicant.get')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        :{
                                    _token:$('meta[name="csrf-token"]').attr('content'),
                                    id:id,
                                    },
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        $('#edit_applicants').val(response.data.recruit_id);
                        $('#a_name').val(response.data.name);
                        $('#a_faculty').val(response.data.fac_id);
                        $('#a_department').val(response.data.department);
                        $('#a_level').val(response.data.batch);
                        $('#a_status').val(response.data.apply_status);

                        $('#updatepopup').modal('toggle');
                    }else if(response.status=='204'){
                        alert('No such Recruitment in database.');
                    }
                });
            }
            $('#editform').submit(function(e) {
                e.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('applicant.update')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        : formData,
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        alert("data updated");
                    }else if(response.status=='204'){
                        alert("no such data");
                    }else{
                        alert("error");
                    }

                    $('#editform').each(function(){
                        this.reset();
                    });
                }).fail(function(response) {
                    console.error(response);
                });
                $('#updatepopup').modal('toggle');
            });

              //filtering
              function filter(id){
                    $.ajax({
                        url:'{{route('applicant.filter')}}',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'POST',
                        dataType:'json',
                        data:{
                            _token:$('meta[name="csrf-token"]').attr('content'),
                            id:id,
                        },
                        success:function(response){
                            if(response.status == '200'){
                                alert("Applicants filtered");

                            }else{
                                alert('No such applicants in database.');
                            }
                        },
                    })
            }
      </script>

      <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/extensions/export/bootstrap-table-export.min.js"></script>
    @endpush

@endsection

