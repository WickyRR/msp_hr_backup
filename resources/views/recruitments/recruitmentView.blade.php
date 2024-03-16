@extends('layouts.app', ['page' => __('View Process'), 'pageSlug' => 'recruitprocess.view'])
@section('content')
@push('pageSpecificCSS')
   <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
   <style>
      .modal-dialog {
        margin: -25vh auto 0px auto;
        }
        /*css of text editor*/


            .fr-view
            {
                background-color: rgb(18, 30, 61);
            }
            .fr-toolbar,.fr-second-toolbar
            {
                background-color: #27293d;

            }
            .fr-svg,.fr-sr-only,.fr-more-toolbar,.fr-expanded,.fr-newline
            {
                background-color: grey;
                border-radius: 10px;
            }
            .fr-dropdown-list
            {
                background-color: black;
            }
            .fr-toolbar .fr-more-toolbar
            {
                background-color: rgb(73, 70, 70);
            }
            .fr-quick-insert
            {
                background-color: black;
            }
            .card-footer
            {
                background-color: rgb(18, 30, 61);
            }
            .modal-content .modal-body p
            {
                color: white;
            }
            label
            {
                color: grey;
            }

     </style>
@endpush
<div id="viewBody">
    <div style="background-color: rgb(18, 30, 61)">
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        <table data-toggle="table" id="table" class="table table-striped table-dark">
           <thead>
            <th style="color: white;" data-field="process_name">Process Name</th>
            <th style="color: white;" data-field="instructions">Instructions</th>
            <th style="color: white;" data-field="Contacts">Contacts</th>
            <th style="color: white;" data-field="year">Year</th>
            <th style="color: white;" data-field="s_date">Start Date</th>
            <th style="color: white;" data-field="c_date">Close Date</th>
            <th style="color: white;" data-field="status">Process Status</th>
            <th style="color: white;">Action</th>
           </thead>
           <tbody>
            @foreach ($recruit_process_list as $recruit_process)
                        <tr id="rid{{ $recruit_process->recruit_process_id }}">

                            <td>{{ $recruit_process->process_name }}</td>
                            <td>{{ $recruit_process->instructions }}</td>
                            <td>{{ $recruit_process->contact_details }}</td>
                            <td>{{ $recruit_process->activeYear->year }}</td>
                            <td>{{ $recruit_process->start_date }}</td>
                            <td>{{ $recruit_process->close_date }}</td>
                            @if ($recruit_process->process_status)
                                <td>Open</td>
                            @else
                                <td>Closed</td>
                            @endif
                            <td>
                                <a href="javascript:void(0)" class="btn btn-primary announce" data-toggle="modal" data-id="{{ $recruit_process->recruit_process_id }}" >Delete</a>
                              <br/><br/>
                                <a href="javascript:void(0)" onclick="editRecruitment({{ $recruit_process->recruit_process_id }})" class="btn btn-info">Update</a>
                            </td>
                        </tr>
            @endforeach
           </tbody>


          </table>
    </div>
</div>
<!-- modal start -->
<div class="modal fade" id="recruitmentEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" id="modal-content" style="background-color: rgb(18, 30, 61);margin-top: 0px;">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel" style="color: white;">Update Recruitment</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="recruitmentEditForm" >
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label for="pname">Process Name</label>
                        <input name="pname" type="text" class="form-control" id="pname">
                    </div>

                    <div class="form-group">
                        <label for="contacts">Contacts</label>
                        <textarea class="form-control" name="contacts" id="contacts" style="border: 1px solid rgb(61, 61, 61);border-radius: 9px;" rows="1"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="year">Year</label>
                        <select name="year" class="form-control" id="year">
                            @foreach($active_years_list as $active_year)
                                <option value="{{ $active_year->id }}" style="color: black">
                                    {{ $active_year->year }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="sdate">Start Date</label>
                        <input type="text" class="form-control" name="sdate" id="sdate">
                    </div>
                    <div class="form-group">
                        <label for="cdate">Close Date</label>
                        <input type="text" class="form-control" name="cdate" id="cdate" >
                    </div>
                    <div class="form-group">
                        <label for="status">Process Status</label>
                        <select name="status" class="form-control" id="status">
                            <option value="1" style="color: black;">Open</option>
                            <option value="0"  style="color: black;">Closed</option>
                        </select>
                    </div>
                    <label>Instructions</label><br/>
                        <div class="card-footer">
                            <textarea class="form-control" name="instructions" id="instructions" rows="5"></textarea><br/>

                        </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <span id="error-message" class="test-danger"></span>
                    <span id="success_message" class="test-success"></span>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->

<!-- modal for delete -->
<div class="modal fade" id="recruitmentDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="exampleModalLongTitle">Are You Sure?</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5 style="color: #27293d;">Do you really want to delete this Recruit Process?</h5>
            <p style="color: red;">This will delete all the CVs in the server and this cannot be undone.</p>
            <form>
                <input type="hidden" name="recID" id="recID" />
                <fieldset>

                    <div class="control-group">
                        <div class="controls">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" onclick="deleteRecruitment(document.getElementById('recID').value)">Delete</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </fieldset>
            </form>
        </div>

      </div>
    </div>
  </div>

<!-- modal end-->

    @push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
        <script src="{{asset('js/alert-box.js')}}"></script>
        <script>
            function editRecruitment(id){
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('recruitment.get')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        :{
                                    _token:$('meta[name="csrf-token"]').attr('content'),
                                    id:id,
                                    },
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        console.log(response.data);
                        $("#id").val(response.data.recruit_process_id);
                        $("#pname").val(response.data.process_name);
                        editor.html.set(response.data.instructions);
                        $("#instructions").val(response.data.instructions);
                        $("#contacts").val(response.data.contact_details);
                        $("#year").val(response.data.year_id);
                        $("#sdate").val(response.data.start_date);
                        $("#cdate").val(response.data.close_date);
                        $("#status").val(response.data.process_status);
                        $("#recruitmentEditModal").modal('toggle');
                    }else if(response.status=='204'){
                        alertBox.showAlertBox('bottom','right','danger','No such Recruitment in database.',8000);
                    }
                });
            }
            $('#recruitmentEditForm').submit(function(event) {
                event.preventDefault();
                var formData = $(this).serialize();
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('recruitment.update')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        : formData,
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        alertBox.showAlertBox('bottom','right','success','Recruitment was successfully updated.',8000);
                    }else if(response.status=='422'){
                        alertBox.showAlertBox('bottom','right','danger','Data validation failed. Check the input again.',8000);
                        $.each(response.error, function( key, value ) {
                            alertBox.showAlertBox('bottom','right','danger',value,10000);
                        });
                    }else{
                        alertBox.showAlertBox('bottom','right','danger','No such Recruitment in database.',8000);
                    }
                    $('#recruitmentEditForm').each(function(){
                        this.reset();
                    });
                }).fail(function(response) {
                    console.error(response);
                });
                //location.reload("#table");
                //$('#table').trigger("reset");
                $("#recruitmentEditModal").modal('toggle');
            });

            flatpickr("#sdate", {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
           flatpickr("#cdate", {
               enableTime: true,
               dateFormat: "Y-m-d H:i",
           });

           var editor = new FroalaEditor('#instructions',{
                height:100,
            });

            $(document).ready(function(){ //  function for show delete modal and pass id to the modal
                $(".announce").click(function(){ // Click to only happen on announce links
                    $("#recID").val($(this).data('id'));
                    console.log($(this).data('id'));
                    $('#recruitmentDeleteModal').modal('show');
                });
            });

            function deleteRecruitment(id){
                    $.ajax({
                        url:'{{route('recruitment.delete')}}',
                        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type:'DELETE',
                        dataType:'json',
                        data:{
                            _token:$('meta[name="csrf-token"]').attr('content'),
                            id:id,
                        },
                        success:function(response){
                            if(response.status == '200'){
                                alertBox.showAlertBox('bottom','right','success','Recruitment was successfully deleted.',8000);
                                $('#rid'+response.data.recruit_process_id).remove();
                            }else{
                                alertBox.showAlertBox('bottom','right','danger','No such Recruitment in database.',8000);
                            }
                        },
                    })
            }
        </script>
    @endpush
    @endsection
