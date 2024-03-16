@extends('layouts.app', ['page' => __('View Projects'), 'pageSlug' => 'projects.view'])
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

            option {
                color: black;
            }
            .tableScrollable{
                height:200px;
                overflow-y:auto;
                width: 100%;
                display:block;
             }
        </style>
    @endpush
    <div id="viewBody">
        <div style="background-color: rgb(18, 30, 61)">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif

            <table data-toggle="table" id="table" class="table table-striped table-dark" style="text-align: center">
                <thead>
                <th style="color: white;padding: 20px;" data-field="prject_name">Project Name</th>
                <th style="color: white; padding: 20px;" data-field="project_description">Description</th>
                <th style="color: white; padding: 20px;" data-field="pillar">Pillar</th>
                <th style="color: white; padding: 20px;" data-field="project_status">Status</th>
                <th style="color: white;padding: 20px;" data-field="start_date">Start Date</th>
                <th style="color: white;padding: 20px;" data-field="end_date">Close Date</th>
                </thead>
                <tbody>
                @foreach ($project_list as $project)
                    <tr id="rid{{ $project->id }}">

                        <td>{{ $project->project_name }}</td>
                        <td>{{ ($project->project_description) }}</td>
                        @foreach ($pills as $pill)
                            @if($project->pillar_id==$pill->pillar_id)
                                <td>{{ $pill->pillar_name }}</td>
                            @endif
                        @endforeach
                        @if ($project->project_status)
                            <td>Open</td>
                        @else
                            <td>Closed</td>
                        @endif
                        <td>{{ $project->start_date }}</td>
                        <td>{{ $project->end_date }}</td>

                        <td>

                            <a href="javascript:void(0)" onclick="crewLoad({{ $project->id }})" class="btn btn-info">
                                Crew</a>
                            <br/><br/>
                            <a href="javascript:void(0)" onclick="editProject({{ $project->id }})" class="btn btn-info">Update</a>
                            <br/><br/>
                            <a href="javascript:void(0)" class="btn btn-primary announce" data-toggle="modal"
                               data-id="{{ $project->id }}">Delete</a>

                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>
    </div>
    <!-- modal start -->
    <div class="modal fade" id="projectEditModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content" style="background-color: rgb(18, 30, 61);margin-top: 0px;">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color: white;">Update Project</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="projectEditForm">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <div class="form-group">
                            <label for="pname">Project Name</label>
                            <input name="project_name" type="text" class="form-control" id="project_name">
                        </div>

                        <div class="form-group">
                            <label for="year">Pillar</label>
                            <select name="pillar" class="form-control{{ $errors->has('pillar') ? ' is-invalid' : '' }}"
                                    id="pillar" required>
                                <option @if (old('pillar')==null) selected="selected" @endif disabled="true">Please
                                    select
                                </option>
                                @foreach ($pills as $pill)
                                    <option value="{{$pill->pillar_id}}" style="color: black"
                                            @if (old('pillar')==$pill->pillar_id) selected="selected" @endif>{{$pill->pillar_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="sdate">Start Date</label>
                            <input type="text" class="form-control" name="start_date" id="start_date">
                        </div>
                        <div class="form-group">
                            <label for="cdate">End Date</label>
                            <input type="text" class="form-control" name="end_date" id="end_date">
                        </div>
                        <div class="form-group">
                            <label for="status">Project Status</label>
                            <select name="project_status" class="form-control" id="status">
                                <option value="1" style="color: black;">Open</option>
                                <option value="0" style="color: black;">Closed</option>
                            </select>
                        </div>
                        <label>Project Description</label><br/>
                        <div class="card-footer">
                            <textarea class="form-control" name="project_description" id="instructions"
                                      rows="5"></textarea><br/>
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

    <!-- modal start -->
    <div class="modal fade" id="projectCrewModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content" style="background-color: rgb(18, 30, 61);margin-top: 30%">
                <div class="modal-header">
                    <h3 class="modal-title" id="exampleModalLabel" style="color: white;">Crew Members</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="projectCrewAdd">
                        @csrf
                        <input type="hidden" id="crew_projectid" name="crew_projectid">

                        <br/>

                        <div class="form-group">
                            <label for="pillar_list">Select Pillar</label>
                            <select name="pillar_list"
                                    class="form-control{{ $errors->has('pills') ? ' is-invalid' : '' }}"
                                    id="pillar_list" required
                                    onchange="pillarSelected(this.selectedIndex)">
                                <option @if (old('pills')==null) selected="selected" @endif disabled="true">
                                    Please select
                                </option>
                                @foreach ($pills as $pill)

                                    <option value="{{$pill->pillar_id}}" style="color: black"
                                            @if (old('pillar_members')==$pill->pillar_id) selected="selected" @endif>{{$pill->pillar_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="member_name">Member Name</label>
                            <select name="pillar_member"
                                    class="form-control{{ $errors->has('pillar_members') ? ' is-invalid' : '' }}"
                                    id="pillar_member" required style="color: white;">

                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Add Member</button>
                        <span id="error-message" class="test-danger"></span>
                        <span id="success_message" class="test-success"></span>
                    </form>

                    <br/>

                    <div style="background-color: rgb(18, 30, 61)">
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        <table data-toggle="crew_table" id="crew_table" class="table table-striped table-dark tableScrollable"
                               style="text-align: center; color: white;">
                            <!--Table data are filled in javascript-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- modal end -->

    <!-- modal for delete -->
    <div class="modal fade" id="projectDeleteModal" tabindex="-1" role="dialog"
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
                    <h5 style="color: #27293d;">Do you really want to delete this Project?</h5>
                    <p style="color: red;">This will delete all the data related to this project and cannot be
                        undone</p>
                    <form>
                        <input type="hidden" name="project_id" id="project_id"/>
                        <fieldset>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            onclick="deleteRecruitment(document.getElementById('project_id').value)">
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

    <!-- modal for delete -->
    <div class="modal fade" id="crewDeleteModel" tabindex="-1" role="dialog"
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
                    <h5 style="color: #27293d;">Do you really want to delete this crew member??</h5>
                    <p style="color: red;">This will delete all the data related to this member and cannot be
                        undone</p>
                    <form>
                        <input type="hidden" name="member_id" id="member_id"/>
                        <fieldset>

                            <div class="control-group">
                                <div class="controls">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal"
                                            onclick="deleteCrewConfirm(document.getElementById('member_id').value,document.getElementById('crew_projectid').value)">
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
            function editProject(id) {
                console.log("id : " + id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.get')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                    },
                    dataType: 'json',
                    encode: true
                }).done(function (response) {
                    if (response.status == '200') {
                        console.log(response.data);
                        console.log("Data Loaded")
                        $("#id").val(response.data.id);
                        $("#project_name").val(response.data.project_name);
                        editor.html.set(response.data.project_description);
                        $("#instructions").val(response.data.project_description);
                        $("#pillar").val(response.data.pillar_id);
                        $("#start_date").val(response.data.start_date);
                        $("#end_date").val(response.data.end_date);
                        $("#project_status").val(response.data.project_status);
                        $("#projectEditModal").modal('toggle');
                    } else if (response.status == '204') {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'No such Project in database.', 8000);
                    }
                });
            }

            $('#projectEditForm').submit(function (event) {
                event.preventDefault();
                console.log("update started");
                var formData = $(this).serialize();
                console.log(formData);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.update')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    dataType: 'json',
                    encode: true
                }).done(function (response) {
                    if (response.status == '200') {
                        alertBox.showAlertBox('bottom', 'right', 'success', 'Project was successfully updated.', 8000);
                    } else if (response.status == '422') {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'Data validation failed. Check the input again.', 8000);
                        $.each(response.error, function (key, value) {
                            alertBox.showAlertBox('bottom', 'right', 'danger', value, 10000);
                        });
                    } else {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'No such Project in database.', 8000);
                    }
                    $('#projectEditForm').each(function () {
                        this.reset();
                    });
                }).fail(function (response) {
                    console.log("Error");
                    console.error(response);
                });
                location.reload("#table");
                $('#table').trigger("reset");
                $("#projectEditModal").modal('toggle');
            });

            flatpickr("#start_date", {
                enableTime: true,
                dateFormat: "Y-m-d",
            });
            flatpickr("#end_date", {
                enableTime: true,
                dateFormat: "Y-m-d",
            });

            var editor = new FroalaEditor('#instructions', {
                height: 100,
            });

            $(document).ready(function () { //  function for show delete modal and pass id to the modal
                $(".announce").click(function () { // Click to only happen on announce links
                    $("#project_id").val($(this).data('id'));
                    console.log($(this).data('id'));
                    $('#projectDeleteModal').modal('show');
                });

            });

            function deleteRecruitment(id) {
                console.log("Deleting ID : " + id);
                $.ajax({
                    url: '{{route('projects.delete')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                    },
                    success: function (response) {
                        if (response.status == '200') {
                            alertBox.showAlertBox('bottom', 'right', 'success', 'Project was successfully deleted.', 8000);
                            location.reload("#table");
                            $('#table').trigger("reset");
                            //$('#rid' + response.data.recruit_process_id).remove();
                        } else {
                            alertBox.showAlertBox('bottom', 'right', 'danger', 'No such Project in database.', 8000);
                        }
                    },
                })
            }

            function projectCrew(id) {
                //console.log("Project ID : " + id);
                $("#crew_projectid").val(id);
                $("#projectCrewModel").modal('toggle');
            }

            function crewLoad(id) {
                $("#crew_projectid").val(id);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.crewget')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                    },
                    dataType: 'json',
                    encode: true
                }).done(function (response) {
                    /*if (response.status == '200') {
                        alertBox.showAlertBox('bottom', 'right', 'success', 'Project Crew was successfully updated.', 8000);
                    } else if (response.status == '422') {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'Data validation failed. Check the input again.', 8000);
                        $.each(response.error, function (key, value) {
                            alertBox.showAlertBox('bottom', 'right', 'danger', value, 10000);
                        });
                    } else {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'FAILED', 8000);
                    }*/
                    //console.log(response.original);
                    $("#crew_projectid").val(id);
                    console.log(id);
                    $("#projectCrewModel").modal('toggle');
                    crewLoaded(response.original, '#crew_table');

                }).fail(function (response) {
                    console.log("Error");
                    console.error(response.data);
                });
            }

            function crewLoaded(myList, selector) {
                console.log("myList : " + myList);
                $('#projectCrewAdd').each(function () {
                    this.reset();
                });
                //var crew_table = document.getElementById("crew_table");
                $("#crew_table tr").remove();
                const jsondata = JSON.parse(myList);
                buildHtmlTable(jsondata, selector)
                //crew_table.insertRow(0);
                /*for(let i=0; i<response.data().length; i++){

                }*/
                //return response.data;
            }

            $('#projectCrewAdd').submit(function (event) {
                event.preventDefault();
                console.log("crew add started");
                var formData = $(this).serialize();
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.crewadd')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: formData,
                    dataType: 'json',
                    encode: true
                }).done(function (response) {
                    if (response.status == '200') {
                        alertBox.showAlertBox('bottom', 'right', 'success', 'Project Crew was successfully updated.', 8000);
                    } else if (response.status == '422') {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'Data validation failed. Check the input again.', 8000);
                        $.each(response.error, function (key, value) {
                            alertBox.showAlertBox('bottom', 'right', 'danger', value, 10000);
                        });

                    } else if (response.status == '409') {
                        alertBox.showAlertBox('bottom', 'right', 'danger', "This member is already added", 10000);
                        console.log(response.data);
                    } else {
                        alertBox.showAlertBox('bottom', 'right', 'danger', 'FAILED', 8000);
                    }
                    crewLoaded(response.data.original, '#crew_table');

                }).fail(function (response) {
                    console.log("Error");
                    console.error(response.data);
                });
                //location.reload("#crew_table");
                //$('#crew_table').trigger("reset");
                //$("#projectCrewModel").modal('toggle');
            });

            // Builds the HTML Table out of myList.
            function buildHtmlTable(myList, selector) {
                var columns = addAllColumnHeaders(myList, selector);

                var member_id_for_delete;
                for (var i = 0; i < myList.length; i++) {
                    var row$ = $('<tr/>');
                    for (var colIndex = 0; colIndex < columns.length; colIndex++) {
                        var cellValue = myList[i][columns[colIndex]];
                        if (cellValue == null) cellValue = "";
                        row$.append($('<td/>').html(cellValue));

                    }
                    var member_id_for_delete = myList[i]["ID"];
                    console.log("mfd : " + member_id_for_delete);
                    row$.append($('<td/>').html("<a onclick='deleteCrew(this)' class=\"btn btn-info announce\" data-toggle=\"modal\" data-id=" + member_id_for_delete + ">Delete</a>"));
                    $(selector).append(row$);
                }
            }

            // Adds a header row to the table and returns the set of columns.
            // Need to do union of keys from all records as some records may not contain
            // all records.
            function addAllColumnHeaders(myList, selector) {
                var columnSet = [];
                var headerTr$ = $('<tr/>');

                for (var i = 0; i < myList.length; i++) {
                    var rowHash = myList[i];
                    for (var key in rowHash) {
                        if ($.inArray(key, columnSet) == -1) {
                            if(key!="ID"){
                                columnSet.push(key);
                                headerTr$.append($('<th/>').html(key));
                            }

                        }
                    }
                }

                $(selector).append(headerTr$);

                return columnSet;
            }

            function deleteCrew(button) {
                var member_id = $(button).data('id');
                //console.log("Deleting ID : " + $(button).data('id'));
                console.log(member_id);
                $("#member_id").val(member_id);
                $('#crewDeleteModel').modal('show');
            }

            function deleteCrewConfirm(id, project_id) {
                //var cur_projectID = $("#crew_projectid").innerText;
                console.log(project_id);
                $.ajax({
                    url: '{{route('projects.crewdelete')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type: 'DELETE',
                    dataType: 'json',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: id,
                        project_id: project_id,
                    },
                    success: function (response) {
                        if (response.status == '200') {
                            alertBox.showAlertBox('bottom', 'right', 'success', 'Crew member was successfully deleted.', 8000);
                        } else if (response.status == '422') {
                            alertBox.showAlertBox('bottom', 'right', 'danger', 'Data validation failed. Check the input again.', 8000);
                            $.each(response.error, function (key, value) {
                                alertBox.showAlertBox('bottom', 'right', 'danger', value, 10000);
                            });
                        } else {
                            alertBox.showAlertBox('bottom', 'right', 'danger', response.message, 8000);
                        }
                        crewLoaded(response.data.original, '#crew_table');
                    },
                })
            }

            function pillarSelected(pillarID) {
                console.log(pillarID);
                $.ajax({
                    type: 'POST',
                    url: '{{ route('projects.pillarmemberget')}}',
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        id: pillarID,
                    },
                    dataType: 'json',
                    encode: true
                }).done(function (response) {
                    console.log(response);

                    select = document.getElementById('pillar_member');
                    $("#pillar_member option").remove();
                    var jsondata = JSON.parse(response);
                    for (var i = 0; i < jsondata.length; i++) {
                        console.log("i : " + i);
                        let opt = document.createElement('option');
                        console.log(jsondata[i]);
                        opt.value = jsondata[i].ID;
                        opt.innerHTML = jsondata[i].NAME;
                        select.appendChild(opt);
                    }
                }).fail(function (response) {
                    console.log("Error");
                    console.error(response);
                });

            }
        </script>
    @endpush
@endsection
