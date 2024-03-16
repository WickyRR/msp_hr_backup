<?php

namespace App\Http\Controllers;
use App\Models\KPI_Scores;
use Illuminate\Support\Facades\DB;
use App\Models\PillarMember;
use Illuminate\Http\Request;

class KPIController extends Controller
{
    public function getHR(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',1)
        ->get();
        return view('pillar_members.hrKpi')->with('kpis',$kpis); ;
       }

    public function getDesign(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',2)
        ->get();
        return view('pillar_members.designKpi')->with('kpis',$kpis); ;
    }

    public function getNews(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',3)
        ->get();
        return view('pillar_members.newsKpi')->with('kpis',$kpis); ;
    }

    public function getMarketing(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',4)
        ->get();
        return view('pillar_members.marketingkpi')->with('kpis',$kpis); ;
    }

    public function getSpecial(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',5)
        ->get();
        return view('pillar_members.specialKpi')->with('kpis',$kpis); ;
    }

    public function getCoop(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',6)
        ->get();
        return view('pillar_members.coopKpi')->with('kpis',$kpis); ;
    }

    public function getEditorial(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',7)
        ->get();
        return view('pillar_members.editorialKpi')->with('kpis',$kpis); ;
    }

    public function getWeb(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',8)
        ->get();
        return view('pillar_members.webKpi')->with('kpis',$kpis); ;
    }

    public function getVideo(){
        $kpis = DB::table('k_p_i__scores')
        ->join ('pillar_members','k_p_i__scores.id',"=","pillar_members.id")
        ->where('pillar_members.pillar',9)
        ->get();
        return view('pillar_members.videoKpi')->with('kpis',$kpis); ;
    }

    public function updateScores(Request $request){
        DB::table('k_p_i__scores')
            ->updateOrInsert(
                ['id'=> ($request->id)],
                [$request->field=>($request->value)]
            );
        
        return redirect()->back();

    }
}
