<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faculty;
use App\Models\Pillar;
use App\Models\District;
use App\Models\PillarMember;
use App\Models\KPI_Scores;
use Illuminate\Support\Facades\DB;

class MemberFormController extends Controller
{
    public function memberCollection(){
        $fac=Faculty::all();
        $pills=Pillar::all();
        $dist=District::all();
        return view('memberForm.collection')->with(['faculty'=>$fac,'pillars'=>$pills,'districts'=>$dist]);
    }

    public function store(Request $request){
        $memberdetails=new PillarMember;


        $this->validate($request, [
            'first_name' => ['string', 'required'],
            'last_name' => ['string', 'required'],
            'email' => ['string', 'required'],
            'district' => ['string', 'required'],
            'town' => ['string', 'required'],
            'contact_no' => ['string', 'required'],
            'pillar' => ['string', 'required'],
            'faculty' => ['string', 'required'],
            'batch' => ['string', 'required'],
            'birth_date' => ['date', 'required'],
            'photo' => ['string', 'required'],
        ]);

        
        $district=(int)$request->district;
        // $districtId=DB::table('districts')
        //                 ->where('id',$district)
        //                 ->get('id');
        // //dd($districtId);
       
        $districtId=District::where('id',$district)->first();
        // dd($districtId);

        $memberdetails->first_name=$request->first_name;
        $memberdetails->last_name=$request->last_name;
        $memberdetails->email=$request->email;
        $memberdetails->nearest_town=$request->town;
        $memberdetails->contact_number=$request->contact_no;
        $memberdetails->pillar=$request->pillar;
        $memberdetails->faculty=$request->faculty;
        $memberdetails->batch=$request->batch;
        $memberdetails->facebook_url=$request->fb_url;
        $memberdetails->instagram_url=$request->insta_url;
        $memberdetails->birthday=$request->birth_date;
        $memberdetails->photo_url=$request->photo;
        $memberdetails->district_id=$districtId->id;
        //$memberdetails->id=$maxmemberID+1;

        try{
            $memberdetails->save();
        }catch(\Exception $e){
            return redirect()->back()->withInput()->withErrors(['db_ins_fail' => 'Invalid input found. Please contact us if this error continues.']);
        }
        $kId=KPI_Scores::all();
        $kpiId=new KPI_Scores;
        if($kId->isEmpty()){
            $kpiId->id=1;
        }else{
            $kId=KPI_Scores::all()->last()->id;
            $kpiId->id=$kId+1;
        }
        $kpiId->save();
        
        return redirect()->route('saveMember.success');
    }

    public function success()
    {
        $msg = "Member Details Saved Successfully.";
        return view('memberForm.message', [
            'custom_message' => $msg,
            'page_title' => 'Collection Successful'
        ]);
    }
}
