@extends('layouts.app', ['page' => __('View HR'), 'pageSlug' => 'hr.view'])

@section('content')

@push('pageSpecificCSS')
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
  <style>
  #openModel {
    outline:none;
    border-style: none;
  }
  .modal-dialog {
          position: absolute;
          top: -150px;
          right: -100px;
          bottom: 0;
          left: 0;
          z-index: 10040;
          overflow: auto;
          overflow-y: auto;        
        }
        
  .modal-content{
    border-width: 0;

  }
#body_m{
    padding-top: .10em;
  }
 </style>
 @endpush

<!-- strat the model -->
<!-- Modal -->
<div class="modal fade text-white rounded-10"  id="viewMoreDetailsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content bg-dark">
    
      <div class="modal-header  "  id="modal_title">
      
        <button type="button" class="close_modal close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>       
      </div>
      <div id="f_name" class="bg-dark text-white"></div>
      <div class="modal-body bg-dark" id ="body_m">  
        <div id="sucess_message" ></div>
          <dl class="row" >
          </dl>
        </div>
      </div>
  </div>
</div>
<!-- end the model -->

<!-- table -->
<div>
<table class="table table-striped table-dark">
  <thead>
    <tr>
      <th scope="col">Name</th>
      <th scope="col">E-mail</th>
      <th scope="col">Contact</th>
      <th scope="col">Faculty</th>
      <th scope="col">Action</th>
     
    </tr>
  </thead>
  <tbody>
  @foreach($members as $member)
    <tr>
      <th scope="row" class="text-white">{{ $member->first_name }}</th>
      <td scope="row" class="text-white">{{ $member->email }}</td>
      <td scope="row" class="text-white">{{ $member->contact_number }}</td>
      <td scope="row" class="text-white">{{ $member->fac_name }}</td>
      <td scope="row">
        <button class="view_more btn btn-primary btn-sm " value="{{ $member->id }}" id="openModel">more</button> </td>
        <input type="hidden" value = "{{ $member->pillar }}" name ="pillarid" >
        
      </td>
     
    </tr>
    @endforeach
  
  </tbody>
</table>
<!-- end of table -->
</div>




@push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script>

      $(document).ready(function (){

        $(document).on('click','.view_more', function (e){
          e.preventDefault();
          var member_id = $(this).val();
          var pillar_id = $("input[name='pillarid']").val();
          // console.log(member_id);
          // console.log(pillar_id);
          $('#viewMoreDetailsModel').modal('show');

          $.ajax({
            type:"GET",
            
            url:"/moreDetails/"+member_id+'/'+pillar_id,
            datatype:"json",
            success:function (response){
           
              console.log(response);
              if(response.status == 404){
                $('#sucess_message').html("");
                $('#sucess_message').addClass('alert alert-danger');
                $('#sucess_message').text(response.message);
              }else{          
                $('dl').html("");
                $('#f_name').html("");
                var c_no =  response.details.contact_number;
                $.each(response.details, function (key,item) {
                  var t_kpi= parseFloat(item.jan)+parseFloat(item.feb)+parseFloat(item.march)+parseFloat(item.april)+parseFloat(item.may)+parseFloat(item.june)+parseFloat(item.july)+parseFloat(item.aug)+parseFloat(item.sep)+parseFloat(item.oct)+parseFloat(item.nov)+parseFloat(item.dec);
                  if(t_kpi > 0 ){
                    t_kpi = t_kpi;         
                  }else{
                    t_kpi= 0;
                  }
                  var fbUrl = item.facebook_url;
                  var instagramUrl = item.instagram_url; 
                  if(fbUrl == null){
                      fbUrl = " ";
                  }

                  if (instagramUrl == null){
                    instagramUrl = " ";
                  }

                  
                  var full_name = item.first_name + " " + item.last_name; 
                  var c_no =  item.contact_number;
                $('#f_name').append('<h3 class="text-center text-white" id="f_name" >'+full_name+'</h3>\
                '); 
                $('dl').append('<dt class="col-sm-5">Contact Number</dt>\
                <dd class="col-sm-7" id="c_no">'+c_no+'</dd>\
                <dt class="col-sm-5">Email</dt>\
                <dd class="col-sm-7" id="email">'+item.email+'</dd>\
                <dt class="col-sm-5">District</dt>\
                <dd class="col-sm-7" id="n_town">'+item.district_name+'</dd>\
                <dt class="col-sm-5">Nearest Town</dt>\
                <dd class="col-sm-7" id="n_town">'+item.nearest_town+'</dd>\
                <dt class="col-sm-5">Faculty</dt>\
                <dd class="col-sm-7" id="fac_name">'+item.fac_name+'</dd>\
                <dt class="col-sm-5">Batch</dt>\
                <dd class="col-sm-7" id="batch">'+item.batch+'</dd>\
                <dt class="col-sm-5">Birthday</dt>\
                <dd class="col-sm-7" id="b_day">'+item.birthday+'</dd>\
                <dt class="col-sm-5">Facebook URL</dt>\
                <dd class="col-sm-7" >\
                <a href="'+fbUrl+'" id="instagram"class="text-white" data-toggle="tooltip"  data-placement="top" title="Click to view">'+fbUrl+'</a>\
                </dd>\
                <dt class="col-sm-5">Instagram URL</dt>\
                <dd class="col-sm-7" >\
                <a href="'+instagramUrl+'" id="instagram"class="text-white" data-toggle="tooltip"  data-placement="top" title="Click to view">'+instagramUrl+'</a>\
                </dd>\
                <dt class="col-sm-5">Photo URL</dt>\
                <dd class="col-sm-7" >\
                <a href="'+item.photo_url+'" class="text-white" data-toggle="tooltip"  data-placement="top" title="Click to view" id="p_url">'+item.photo_url+'</a>\
                </dd>\
                <dt class="col-sm-5">Current KPI</dt>\
                <dd class="col-sm-7" id="kpi">'+t_kpi+'</dd>\
                ');
              });

              }
            }

          })
        });

        $(document).on('click','.close_modal', function (e){
          $('#viewMoreDetailsModel').modal('hide');
        });

      });
  

    </script>
@endpush
@endsection


