
    @extends('layouts.app', ['page' => __('Add Recruitment'), 'pageSlug' => 'recruitprocess.add'])
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
                        <h5 class="title">{{ __('Recruitment Process') }}</h5>
                    </div>

                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                    @endforeach

                    <form method="POST" action="{{ route('recruitment.save') }}">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div >
                            <label>Process Name</label>
                            <input type="text" class="form-control" name="process_name" >
                        </div>
                        <div >
                            <label style="">Contact Details</label>
                            <textarea class="form-control" name="contacts" style="border: 1px solid rgb(61, 61, 61);border-radius: 9px;" rows="1"></textarea>
                        </div>
                        <div >
                            <label>Enter Year</label>
                            <select name="year" class="form-control" >
                                @foreach($active_years_list as $active_year)
                                        <option value="{{ $active_year->id }}" style="color: black"
                                                @if($active_year->is_active==1) selected="selected"@endif>
                                            {{ $active_year->year }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div >
                            <label>Start Date</label>
                            <input type="text" class="form-control" name="start_date" id="startDate">
                        </div>
                        <div >
                            <label>Close Date</label>
                            <input type="text" class="form-control" name="close_date" id="closeDate" >
                        </div>
                        <div >
                            <label>Process Status</label>
                            <select name="process_status" class="form-control" >
                            <option value="1" style="color: black;">Open</option>
                            <option value="0"  style="color: black;">Closed</option>
                            </select>
                        </div>

                        <label>Instructions</label><br/>
                        <div class="card-footer">
                            <textarea class="form-control" name="instructions" id="editor" rows="5"></textarea><br/>
                        </div>
                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-fill btn-primary" value="Add Recruitment">
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
                dateFormat: "Y-m-d H:i",
            });
           flatpickr("#closeDate", {
               enableTime: true,
               dateFormat: "Y-m-d H:i",
           });

        </script>
        @endpush
    @endsection


