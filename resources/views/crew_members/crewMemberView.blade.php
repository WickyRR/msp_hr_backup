@extends('layouts.app', ['page' => __('View Crew Members'), 'pageSlug' => 'crewMember.view'])
@section('content')
    <div>

        @push('pageSpecificCSS')
           <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
           <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
           <style>
              .modal-dialog {
                margin: -25vh auto 0px auto;
                }
                /*css of text editor*/
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

                    td {
                    text-align: center;
                    vertical-align: middle;
                    }



             </style>
        @endpush
        <div id="viewBody">
            <div style="background-color: rgb(18, 30, 61)">
                @if (session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                <div>
                    <form  style="width:250px" method="get" >
                    {{ csrf_field() }}
                        <input  type="hidden" id="id" name="id">
                        <select id="process" class="form-control input-lg dynamic" name="process" >
                           <option value="">Select a Year</option>
                           @foreach ($years as $year)
                           <option class="option" style="color:black" value="{{$year->year}}">{{$year->year}}</option>
                           @endforeach
                        </select>
                        <button type="submit" onchange="filter({{$year->year}})" class="btn btn-primary btn-sm">Filter By</button>
                    </form>
                    </div>
                <table data-toggle="table" id="table" class="table table-striped table-dark" data-height="555">
                   <thead>
                    <th style="color: white;" data-field="fname">First Name</th>
                    <th style="color: white;" data-field="lname">Last Name</th>
                    <th style="color: white;" data-field="email">E-Mail</th>
                    <th style="color: white;" data-field="usertype">User Type</th>
                    <th style="color: white;" data-field="batch">Batch</th>
                    <th style="color: white;" data-field="address">Address</th>
                    <th style="color: white;" data-field="birthday">Birth Day</th>
                    <th style="color: white;" data-field="pillar">Pillar</th>
                    <th style="color: white;" data-field="fburl">Facebook URL</th>
                    <th style="color: white;" data-field="instaurl">Instagram URL</th>
                    <th style="color: white;" data-field="action">Action</th>
                   </thead>
                   <tbody>
                    @foreach ($user as $users)
                                <tr>

                                    <td>{{ $users->first_name }}</td>
                                    <td>{{ $users->last_name }}</td>
                                    <td>{{ $users->email  }}</td>
                                    @if ($users->user_type_id == 2)
                                    <td>Exco Member</td>
                                    @else
                                        <td>Crew Member</td>
                                    @endif
                                    <td>{{ $users->batch }}</td>
                                    <td>{{ $users->address }}</td>
                                    <td>{{ $users->birthday }}</td>
                                    <td>{{ $users->pillar }}</td>
                                    <td>{{ $users->facebook_url }}</td>
                                    <td>{{ $users->instagram_url }}</td>
                                    <td>
                                        {{-- <a href="/approved/{{ $users->id }}" class="btn btn-primary btn-sm">View</a> --}}
                                        <a href="#" class="btn btn-primary btn-sm">View</a>
                                    </td>


                                </tr>
                    @endforeach
                   </tbody>


                  </table>
            </div>
        </div>


            @push('pageSpecificJS')
                <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
                <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
                <script src="{{asset('js/alert-box.js')}}"></script>

            @endpush

    </div>
@endsection
