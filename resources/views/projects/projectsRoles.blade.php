@extends('layouts.app', ['page' => __('View Projects'), 'pageSlug' => 'projects.roles'])
@section('content')
    @push('pageSpecificCSS')
        <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet"
              type="text/css"/>
        <style>
            .modal-dialog {
                margin: -25vh auto 0px auto;
            }

            /*css of text editor*/


            .fr-view {
                background-color: rgb(18, 30, 61);
            }

            .fr-toolbar, .fr-second-toolbar {
                background-color: #27293d;

            }

            .fr-svg, .fr-sr-only, .fr-more-toolbar, .fr-expanded, .fr-newline {
                background-color: grey;
                border-radius: 10px;
            }

            .fr-dropdown-list {
                background-color: black;
            }

            .fr-toolbar .fr-more-toolbar {
                background-color: rgb(73, 70, 70);
            }

            .fr-quick-insert {
                background-color: black;
            }

            .card-footer {
                background-color: rgb(18, 30, 61);
            }

            .modal-content .modal-body p {
                color: white;
            }

            label {
                color: grey;
            }

        </style>
    @endpush
    <div id="viewBody">
        <div>
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <a href="javascript:void(0)" onclick="addRole()" class="btn btn-info">Add Member Role</a>

            <br/> <br/>

            <table data-toggle="table" id="table" class="table table-striped table-dark">
                <thead>
                <th style="color: white; text-align: center; padding: 10px; font-size: 15px;" data-field="id">ID</th>
                <th style="color: white; text-align: center; padding: 10px; font-size: 15px;" data-field="role_name">
                    Role Name
                </th>
                </thead>
                <tbody>
                @foreach ($roles as $role)
                    <tr id="rid{{ $role->id }}">
                        <td style="text-align: center;">{{ $role->id }}</td>
                        <td>{{ $role->role }}</td>

                        <td style="text-align: center;">
                            <a href="javascript:void(0)" class="btn btn-primary announce" data-toggle="modal"
                               data-id="{{ $role->id }}">Delete</a>
                            <br/><br/>
                            <a href="javascript:void(0)" onclick="editRole({{ $role->id }})"
                               class="btn btn-info">Update</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>

    <!-- modal start -->
    <div class="modal fade" id="addRoleModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content" style="background-color: rgb(18, 30, 61);margin-top: 50%;">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color: white;">Add Crew Role</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('projects.rolesadd') }}">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="role_name">Role Name</label>
                            <input name="role_name" type="text" class="form-control" id="role_name">
                        </div>

                        <button type="submit" class="btn btn-primary">Add Role</button>
                        <span id="error-message" class="test-danger"></span>
                        <span id="success_message" class="test-success"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- modal start (edit) -->
    <div class="modal fade" id="editRoleModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content" style="background-color: rgb(18, 30, 61);margin-top: 50%;">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color: white;">Edit Crew Role</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id = "roleEditForm">
                        {{ csrf_field() }}
                        <input type="hidden" id="edit_role_id" name="edit_role_id" style="color: black;">
                        <div class="form-group">
                            <label for="edit_role_name">Role Name</label>
                            <input name="edit_role_name" type="text" class="form-control" id="edit_role_name">
                        </div>

                        <button type="submit" class="btn btn-primary">Edit Role</button>
                        <span id="error-message" class="test-danger"></span>
                        <span id="success_message" class="test-success"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- modal for delete -->
    <div class="modal fade" id="roleDeleteModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLongTitle">Are You Sure?</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <h5 style="color: #27293d;">Do you really want to delete this crew role?</h5>
                    <p style="color: red;">This will delete all the data related to this crew role and cannot be
                        undone</p>
                    <form>
                        <input type="hidden" name="delete_role_id" id="delete_role_id"/>
                        <fieldset>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            onclick="deleteRole(document.getElementById('delete_role_id').value)">
                                        Delete
                                    </button>
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
        <script type="text/javascript"
                src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
        <script src="{{asset('js/alert-box.js')}}"></script>
        <script>


            $(document).ready(function () { //  function for show delete modal and pass id to the modal
                $(".announce").click(function () { // Click to only happen on announce links
                    $("#delete_role_id").val($(this).data('id'));
                    console.log($(this).data('id'));
                    $('#roleDeleteModal').modal('show');
                });
            });

            function addRole() {
                $("#addRoleModel").modal('toggle');
            }

            function editRole(id) {
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.roleget')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                    },
                    dataType: 'json',
                    encode: true
                }).done(function (response) {
                    if (response.status == '200') {
                        console.log("id : " + response.data.id);
                        $("#edit_role_id").val(response.data.id);
                        $("#edit_role_name").val(response.data.role);
                        $("#editRoleModel").modal('toggle');
                    } else if (response.status == '204') {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'No such crew role in database.', 8000);
                    }
                });
            }

            $('#roleEditForm').submit(function(event) {
                event.preventDefault();
                console.log("update started");
                //console.log(document.getElementById("edit_role_id").innerText);
                var formData = $(this).serialize();
                $.ajax({
                    type        : 'POST',
                    url         : '{{ route('projects.rolesedit')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        : formData,
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        alertBox.showAlertBox('bottom','right','success','Crew role was successfully updated.',8000);
                    }else if(response.status=='422'){
                        alertBox.showAlertBox('bottom','right','danger','Data validation failed. Check the input again.',8000);
                        $.each(response.error, function( key, value ) {
                            alertBox.showAlertBox('bottom','right','danger',value,10000);
                        });
                    }else{
                        alertBox.showAlertBox('bottom','right','danger','No such role in database.',8000);
                    }
                    $('#roleEditForm').each(function(){
                        this.reset();
                    });
                }).fail(function(response) {
                    console.log("Error");
                    console.error(response);
                });
                //location.reload("#table");
                //$('#table').trigger("reset");
                $("#editRoleModel").modal('toggle');
            });

            function deleteRole(id){
                console.log("Deleting ID : " + id);
                $.ajax({
                    url:'{{route('projects.deleterole')}}',
                    headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type:'DELETE',
                    dataType:'json',
                    data:{
                        _token:$('meta[name="csrf-token"]').attr('content'),
                        id:id,
                    },
                    success:function(response){
                        if(response.status == '200'){
                            alertBox.showAlertBox('bottom','right','success','Crew role ject was successfully deleted.',8000);
                            //$('#rid'+response.data.recruit_process_id).remove();
                        }else{
                            alertBox.showAlertBox('bottom','right','danger','No such crew role in database.',8000);
                        }
                    },
                })
            }

        </script>
    @endpush
@endsection
