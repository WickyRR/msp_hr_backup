@extends('layouts.app', ['page' => __('Add Crew Member'), 'pageSlug' => 'crewMember.add'])
@section('content')
        @push('pageSpecificCSS')

		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

        @endpush

    <div class="row">
        <div class="col-md-8">
            @if (session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <div class="card">
                    <div class="card-header">
                        <h5 class="title">{{ __('Add Members') }}</h5>
                    </div>

                    @foreach ($errors->all() as $error )
                    <div class="alert alert-danger" role="alert">
                        {{ $error }}
                    </div>

                    @endforeach

                    <form method="POST" action="{{ route('crewMember.save') }}">
                        {{ csrf_field() }}
                    <div class="card-body">
                        <div >
                            <label>E-Mail </label>
                            <input type="email" class="form-control" name="email" id="email" >
                        </div>
                        <a href="javascript:void(0)" onclick="addMember()" class="btn btn-info">Add</a>
                        <div >
                            <label>First Name </label>
                            <input type="text" class="form-control" name="fname" id="fname">
                        </div>
                        <div >
                            <label>Last Name </label>
                            <input type="text" class="form-control" name="lname" id="lname">
                        </div>
                        <div >
                            <label>User Type </label>
                            <select name="usertype" class="form-control" id="usertype">
                                <option value="1" style="color: black">Crew Member</option>
                                <option value="2" style="color: black">Exco  Member</option>
                            </select>
                        </div>
                        <div >
                            <label>Batch </label>
                            <select name="batch" class="form-control" id="batch" >
                                <option value="{{$batch}}" style="color: black">{{$batch}}</option>
                                <option value="{{$batch-1}}" style="color: black">{{$batch-1}}</option>
                                <option value="{{$batch-2}}" style="color: black">{{$batch-2}}</option>
                                <option value="{{$batch-3}}" style="color: black">{{$batch-3}}</option>
                            </select>
                        </div>

                        <div >
                            <label>Address </label>
                            <input type="text" class="form-control" name="address" id="address" >
                        </div>
                        <div >
                            <label>Birth Day </label>
                            <input type="text" class="form-control" name="birthday" id="request_date">
                        </div>
                        <div >
                            <label>Pillar </label>
                            <input type="text" class="form-control" name="pillar" id="pillar">
                        </div>
                        <div >
                            <label>Facebook URL </label>
                            <input type="text" class="form-control" name="fburl" id="fburl">
                        </div>
                        <div >
                            <label>Instagram URL </label>
                            <input type="text" class="form-control" name="instaurl" id="instaurl" >
                        </div>




                    </div>
                    <div class="card-footer">
                        <input type="submit" class="btn btn-fill btn-primary" value="Add Member">
                    </div>
                    </form>
                    <br/>
                    <br/>
            </div>


        </div>
    </div>
        @push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script src="{{asset('js/alert-box.js')}}"></script>
        <script>

            flatpickr("#request_date", {
                enableTime: false,
                dateFormat: "Y-m-d",
            });


          </script>
          <script>
              function addMember()
              {
                  var email = document.getElementById("email").value;

                  $.ajax({
                    type        : 'POST',
                    url         : '{{ route('crewMember.get')}}',
                    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data        :{
                                    _token:$('meta[name="csrf-token"]').attr('content'),
                                    email:email,
                                    },
                    dataType    : 'json',
                    encode      : true
                }).done(function(response) {
                    if(response.status=='200'){
                        // console.log(response.user_data[0]);
                        // console.log(response.crew_data[0]);
                        $("#fname").val(response.user_data[0].first_name);
                        $("#lname").val(response.user_data[0].last_name);
                        $("#usertype").val(response.user_data[0].user_type_id);
                        $("#batch").val(response.crew_data[0].batch);
                        $("#address").val(response.crew_data[0].address);
                        $("#request_date").val(response.crew_data[0].birthday);
                        $("#pillar").val(response.crew_data[0].pillar);
                        $("#fburl").val(response.crew_data[0].facebook_url);
                        $("#instaurl").val(response.crew_data[0].instagram_url);

                    }else if(response.status=='204'){
                        alertBox.showAlertBox('bottom','right','danger','No such Member in database.',8000);
                        //console.log(response.message);
                    }
                });


              }
          </script>
        @endpush
    @endsection
