<?php

namespace App\Http\Controllers;
use App\Models\RecruitProcess;
use DB;
class PageController extends Controller
{
    /**
     * Display notifications page
     *
     * @return \Illuminate\View\View
     */
    public function notifications()
    {
        return view('pages.notifications');
    }

    /**
     * Display members page
     *
     * @return \Illuminate\View\View
     */


   public function getAllUser(){
       $recruit_process = RecruitProcess::where('process_status',1)->first();
        $users = DB::table('recruit')
                ->join('faculty','faculty.fac_id','=','recruit.fac_id')

                ->select('recruit.recruit_id','recruit.name','faculty.fac_name','recruit.department','recruit.level','recruit.apply_status','recruit.index_no','recruit.email','recruit.contact_no','recruit.is_old_member','recruit.prev_projects','recruit.sports_do','recruit.clubs','recruit.achievements')
                ->get();

        $skills = DB::table('recruit')
                ->leftJoin('recruit_skills', 'recruit.recruit_id', '=', 'recruit_skills.recruit_id')
                ->leftJoin('skills', 'recruit_skills.skill_id', '=', 'skills.skill_id')
                ->select('recruit.recruit_id','skills.skill_name')
                ->get();

        $pillars = DB::table('recruit')
                ->leftJoin('recruit_pillar', 'recruit.recruit_id', '=', 'recruit_pillar.recruit_id')
                ->leftJoin('pillar', 'recruit_pillar.pillar_id', '=', 'pillar.pillar_id')
                ->select('recruit.recruit_id','pillar.pillar_name')
                ->get();

        return view('pages.members',['users'=>$users,'skills'=>$skills,'pillars'=>$pillars,
            'recruit_process'=>$recruit_process]);
    }
}
