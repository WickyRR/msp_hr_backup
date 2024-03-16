$(document).ready(function(){
/*    $("#faculty").change(function(){
        var fac_id = $(this).val();
        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: 'fetch/departments',
            type: 'post',
            data: {fac_id:fac_id,_token: $('meta[name="csrf-token"]').attr('content')},
            dataType: 'json',
            success:function(response){
                var len = response.data.length;
                var options ='<option disabled="true">Please Select</option>';
                $("#department").empty();
                for( var i = 0; i<len; i++){
                    options += '<option value="' + response.data[i]['dept_id'] + '">' + response.data[i]['dept_name'] + '</option>';
                }
                $("#department").append(options);
            }
        });
    });*/
});
