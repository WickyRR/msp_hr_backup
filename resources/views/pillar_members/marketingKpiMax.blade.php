@extends('layouts.app', ['page' => __('View Marketing Overall Highest KPI'), 'pageSlug' => 'marketingkpi.view'])

@section('content')

@push('pageSpecificCSS')
  <link rel="stylesheet" href="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
  <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <script type='text/javascript'>
    $(document).ready(function(){

    // Show Input element
      $('.edit').click(function(){
      $('.textedit').hide();
      $(this).next('.textedit').show().focus();
      $(this).hide();
    });
    // Save data
  $(".textedit").focusout(function(){

   // Get edit id, field name and value
   var id = this.id;
   var split_id = id.split("_");
   var field_name = split_id[0];
   var edit_id = split_id[1];
   var value = $(this).val();

   // Hide Input element
   $(this).hide();

   // Hide and Change Text of the container with input elmeent
   $(this).prev('.edit').show();
   $(this).prev('.edit').text(value);
    console.log(value);
    console.log(edit_id);
    console.log(field_name);
   $.ajax({

    url: '{{ route('updatescores') }}',
    type:'POST',
    accept: 'application/json',
    headers     :  {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
    data: {  _token:$('meta[name="csrf-token"]').attr('content'),
      field:field_name,
      value:value,
      id:edit_id },
    dataType    : 'json',
    //encode      : true
    }).done(function(response) {
      console.log(response);

    });
  });
});
</script>
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
.edit{
 width: 55%;
 height: 25px;
}
.textedit{
 display: none;
 width: 50%;
 height: 30px;
 color:black;
}
.save{
  float:right;
}

.text-white{
  width:8%;
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
          <th scope="col">Nearest Town</th>
          <th scope="col">Facebook Url</th>
          <th scope="col">Instagram Url</th>


        </tr>
      </thead>
      <tbody>
        @isset($kpisdatas)
        @foreach($kpisdatas as $kpisdata)
        <tr>
          <th scope="row" class="text-white">{{ $kpisdata->first_name }} {{ $kpisdata->last_name }}</th>
          <td scope="row" class="text-white">{{ $kpisdata->email }}</td>
          <td scope="row" class="text-white">{{ $kpisdata->contact_number }}</td>
          <td scope="row" class="text-white">{{ $kpisdata->nearest_town }}</td>
          <td scope="row" class="text-white"><a href="{{ $kpisdata->facebook_url }}" target="blank">{{ $kpisdata->facebook_url }}</a></td>

          <td scope="row" class="text-white"><a href="{{ $kpisdata->instagram_url }}" target="blank">{{ $kpisdata->instagram_url }}</a></td>


        </tr>

        @endforeach
        @endisset
      </tbody>
    </table>
<!-- end of table -->
<div>

        <button><a href="{{ route('marketingkpi.view') }}">Go back To KPI Analysis</a></button>


</div>
</div>






@push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

@endpush
@endsection
