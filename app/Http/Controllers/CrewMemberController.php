<?php

namespace App\Http\Controllers;

use App\Models\ActiveYear;
use Illuminate\Http\Request;
use App\Models\Crew_Members;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CrewMemberController extends Controller
{
    public function add()
    {
        $date = Carbon::now()->format('Y');
        return view('crew_members/crewMemberAdd', ['batch' => $date]);
    }

    public function store(Request $request)
    {
        $crewDetails = new Crew_Members;
        $userDetails = new User;

        $maxuserID = User::max('id');

        $this->validate($request, [
            'fname' => ['string', 'required'],
            'lname' => ['string', 'required'],
            'email' => ['string', 'required'],
            'usertype' => ['int', 'required'],
            'batch' => ['string', 'required'],
            'address' => ['string', 'required'],
            'birthday' => ['date', 'required'],
            'pillar' => ['string', 'required'],
            'fburl' => ['string', 'required'],
            'instaurl' => ['string', 'required'],
            'fburl' => ['string', 'required'],
        ]);



        $userDetails->first_name = $request->fname;
        $userDetails->last_name = $request->lname;
        $userDetails->email = $request->email;
        $userDetails->user_type_id = $request->usertype;
        $crewDetails->batch = $request->batch;
        $crewDetails->address = $request->address;
        $crewDetails->birthday = $request->birthday;
        $crewDetails->pillar = $request->pillar;
        $crewDetails->facebook_url = $request->fburl;
        $crewDetails->instagram_url = $request->instaurl;
        $crewDetails->user_id  = $maxuserID + 1;

        $userDetails->save();
        $crewDetails->save();
        return redirect()->route('crewMember.add');
    }

    public function get(Request $request)
    {

        $member = User::where('email', $request->email)->get();
        // $userID = $member->id;
        //error_log($member[0]->id);
        if ($member != "[]") {
            $member_other_details = Crew_Members::where('user_id', $member[0]->id)->get();
        }
        if ($member != "[]") {
            return response()->json(['status' => '200', 'message' => 'Found Member', 'user_data' => $member, 'crew_data' => $member_other_details]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such Crew Member in database',]);
        }
    }

    public function view()
    {
        //$data=FinanceRequests::all();

        $user = DB::table('crew__members')
            ->join('user', 'crew__members.user_id', '=', 'user.id')
            ->get();
        $years = ActiveYear::all();

        // $user = User::all();
        // $crew = Crew_Members::all();
        return view('crew_members.crewMemberView', ['user' => $user, 'years' => $years]);
    }
}
