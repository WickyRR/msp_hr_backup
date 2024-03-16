@extends('layouts.app', ['page' => __('View HR KPI'), 'pageSlug' => 'hrkpi.view'])

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
      <th scope="col" >ID</th>
      <th scope="col" >JAN</th>
      <th scope="col">FEB</th>
      <th scope="col">MARCH</th>
      <th scope="col">APRIL</th>
      <th scope="col">MAY</th>
      <th scope="col">JUNE</th>
      <th scope="col">JULY</th>
      <th scope="col">AUG</th>
      <th scope="col">SEPT</th>
      <th scope="col">OCT</th>
      <th scope="col">NOV</th>
      <th scope="col">DEC</th>
    </tr>
    <tr>
        <th scope="col">
            <form method="post" action="{{ route('showMaxIdHr') }}">
                @csrf
                <button type="submit">Overall Highest</button>
            </form>
        </th>
        @foreach(['jan', 'feb', 'march', 'april', 'may', 'june', 'july', 'aug', 'sep', 'oct', 'nov', 'dec'] as $month)
        <th scope="col">
            <form method="post" action="{{ route('showMonthlyMaxIdHr',['month'=>$month]) }}">
                @csrf
                <button type="submit">Highest</button>
            </form>
        </th>
        @endforeach
    </tr>
  </thead>

  <tbody>
  @foreach($kpis as $kpi)
  <tr>
      <th scope="row" class="text-white">
        <div class="edit">
           {{ $kpi->id }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->id }}' id='id_{{ $kpi->id }}'>
      </th>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->jan }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->jan }}' id='jan_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->feb }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->feb }}' id='feb_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->march }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->march }}' id='march_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->april }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->april }}' id='april_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->may}}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->may }}' id='may_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->june }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->june }}' id='june_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->july }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->july }}' id='july_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->aug }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->aug }}' id='aug_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->sep }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->sep }}' id='sep_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->oct }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->oct }}' id='oct_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->nov }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->nov }}' id='nov_{{ $kpi->id }}'>
      </td>
      <td scope="row" class="text-white">
        <div class="edit">
          {{ $kpi->dec }}
        </div>
        <input type="text" class="textedit" value='{{ $kpi->dec }}' id='dec_{{ $kpi->id }}'>
      </td>
    </tr>
    @endforeach

  </tbody>
</table>
<!-- end of table -->
<div>


</div>
</div>






@push('pageSpecificJS')
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://unpkg.com/bootstrap-table@1.18.3/dist/bootstrap-table.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>

@endpush
@endsection
