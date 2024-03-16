<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use App\Models\PillarMember;
use Illuminate\Http\Request;

class PillarController extends Controller
{
    //functions to view table
    public function viewHR(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',1)
        ->get();
       return view('pillar_members.hrView')->with('members',$members); ;
       }
    public function viewDesign(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',2)
        ->get();
       return view('pillar_members.designView')->with('members',$members); ;
       }
    public function viewNews(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',3)
        ->get();
       return view('pillar_members.newsView')->with('members',$members); ;
       }
    public function viewMarketing(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',4)
        ->get();
       return view('pillar_members.markertingView')->with('members',$members); ;
       }
    public function viewSproject(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',5)
        ->get();
       return view('pillar_members.sProjectsView')->with('members',$members); ;
       }
    public function viewCdevelopment(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',6)
        ->get();
       return view('pillar_members.cDevelopmentView')->with('members',$members); ;
       }
    public function viewEditorial(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',7)
        ->get();
       return view('pillar_members.editorialView')->with('members',$members); ;
       }
    public function viewWeb(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',8)
        ->get();
       return view('pillar_members.webView')->with('members',$members); ;
       }
    public function viewVEditing(){
        $members = DB::table('pillar_members')
        ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
        ->where('pillar_members.pillar',9)
        ->get();
       return view('pillar_members.VEdittingView')->with('members',$members); ;
       }
//end of table view



//function to show modal
    public function viewMoreDetails($id,$pillar){
            if($pillar == 1){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }
            }elseif($pillar = 2){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }
            }elseif($pillar = 3){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

            }elseif($pillar = 4){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

            }elseif($pillar = 5){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

            }elseif($pillar = 6){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

            }elseif($pillar = 7){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

             }elseif($pillar = 8){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

            }elseif($pillar = 9){
                $details = DB::table('pillar_members')
                ->leftjoin ('k_p_i__scores','pillar_members.id',"=",'k_p_i__scores.id')
                ->join ('faculty','pillar_members.faculty',"=","faculty.fac_id")
                ->join ('districts','pillar_members.district_id',"=",'districts.id')
                ->where('pillar_members.id',$id)
                ->get();
                if($details){
                    return response()->json([
                        'status' => 200,
                        'details' => $details,
                    ]);
                }else{
                    return response()->json([
                        'status' => 404,
                        'message' => 'student not found',
                    ]);
                }

            }
       }
//end of modal
}
