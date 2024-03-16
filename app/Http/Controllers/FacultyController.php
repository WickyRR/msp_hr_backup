<?php

namespace App\Http\Controllers;

use App\Models\Faculty;
use Illuminate\Http\Request;

class FacultyController extends Controller
{
    public function fetchdep(Request $request){
        try{
            $departments=Faculty::find($request->input('fac_id'));
            if($departments!=null){
                $departments=$departments->department;
                $result=array('status'=>'SUCCESS','data'=>$departments);
            }else{
                $result=array('status'=>'ERROR','data'=>'');
            }
        }catch (Exception $exception){
            $result=array('status'=>'ERROR','data'=>'');
        }
        echo json_encode($result);
    }
}
