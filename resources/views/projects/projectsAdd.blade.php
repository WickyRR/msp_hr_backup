
    @extends('layouts.app', ['page' => __('Add Project'), 'pageSlug' => 'projects.add'])
    @section('content')
        @push('pageSpecificCSS')

		<link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
        <style>
            .fr-view
            {
                background-color: rgb(0, 0, 0);
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
            label
            {
                color: grey;
            }

        </style>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
        @endpush
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Projects') }}</h5>
                    </div>

                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                    @endforeach

                    <form method="POST" action="{{ route('projects.save') }}">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div >
                            <label>Project Name</label>
                            <input type="text" class="form-control" name="project_name" >
                        </div>
                        <div >
                            <label>Pillar</label>
                            <select name="pillar" class="form-control{{ $errors->has('pillar') ? ' is-invalid' : '' }}" id="pillar" required>
                                <option @if (old('pillar')==null) selected="selected" @endif disabled="true">Please select</option>
                                    @foreach ($pills as $pill)
                                    <option value="{{$pill->pillar_id}}" style="color: black" @if (old('pillar')==$pill->pillar_id) selected="selected" @endif>{{$pill->pillar_name}}</option>
                                    @endforeach
                                </select>
                        </div>
                        <div >
                            <label>Start Date</label>
                            <input type="text" class="form-control" name="start_date" id="startDate">
                        </div>
                        <div >
                            <label>End Date</label>
                            <input type="text" class="form-control" name="end_date" id="endDate">
                        </div>

                        <label>Project Description</label><br/>
                        <div class="card-footer">
                            <textarea class="form-control" name="project_description" id="editor" rows="5"></textarea><br/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-fill btn-primary" value="Add Project" >

                    </div>
                    </form>
                    <br/>
                    <br/>
            </div>


        </div>
    </div>
        @push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
        <script>
            var editor = new FroalaEditor('#editor',{
                height:250,
            });

            flatpickr("#startDate", {
                enableTime: true,
                dateFormat: "Y-m-d",
            });
           flatpickr("#endDate", {
               enableTime: true,
               dateFormat: "Y-m-d",
           });

           function showText(){
               var txt = $("#project_description").innerHTML;
               console.log(document.getElementById("editor").innerHTML);
            }

        </script>
        @endpush
    @endsection


