<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\KpiScore;

class KPIsortController extends Controller
{


    public function showMaxIdHr()
    {

        $kpiScores = DB::table('k_p_i__scores')
        ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
        ->where('pillar_members.pillar', 1)->get();


        $maxSum = 0;
        $maxIds = [];

        foreach ($kpiScores as $kpiScore) {
            $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

            if ($sum > $maxSum) {
                $maxSum = $sum;
                $maxIds = [$kpiScore->id];
            } elseif ($sum == $maxSum) {
                $maxIds[] = $kpiScore->id;
            }
            $kpisdatas = DB::table('k_p_i__scores')
                        ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                        ->where('pillar_members.pillar', 1)

                        ->whereIn('pillar_members.id',$maxIds)
                        ->select(
                            'k_p_i__scores.id',
                            'pillar_members.first_name',
                            'pillar_members.last_name',
                            'pillar_members.email',
                            'pillar_members.nearest_town',
                            'pillar_members.contact_number',
                            'pillar_members.facebook_url',
                            'pillar_members.instagram_url',
                            'pillar_members.birthday'
                        )
                        ->get();

        }
        return view('pillar_members.hrKpiMax', ['kpisdatas' => $kpisdatas]);
    }
    public function showMonthlyMaxIdHr($month)
{
    $column = strtolower($month);
    $maxKpiScore = DB::table('k_p_i__scores')
        ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
        ->where('pillar_members.pillar', 1)->max('k_p_i__scores.'.$column);


    $kpiScores = KpiScore::all();
    $maxIds = [];
    foreach ($kpiScores as $kpiScore) {
        $kpi = $kpiScore-> $column ;
        if ($maxKpiScore==$kpi) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                        ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                        ->where('pillar_members.pillar', 1)

                        ->whereIn('pillar_members.id',$maxIds)
                        ->select(
                            'k_p_i__scores.id',
                            'pillar_members.first_name',
                            'pillar_members.last_name',
                            'pillar_members.email',
                            'pillar_members.nearest_town',
                            'pillar_members.contact_number',
                            'pillar_members.facebook_url',
                            'pillar_members.instagram_url',
                            'pillar_members.birthday',
                        )
                        ->get();
    }
    return view('pillar_members.hrKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}
/// Design Pillar

public function showMaxIdDesign()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 2)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 2)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.designKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdDesign($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 2)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 2)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.designKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}


////-- News

public function showMaxIdNews()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 3)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 3)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.newsKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdNews($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 3)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 3)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.newsKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}

//// MArketing

public function showMaxIdMarketing()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 4)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 4)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.marketingKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdMarketing($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 4)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 4)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.marketingKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}


///// Special

public function showMaxIdSpecial()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 5)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 5)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.specialKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdSpecial($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 5)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 5)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.specialKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}

///Cooperative
public function showMaxIdCoop()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 6)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 6)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.coopKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdCoop($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 6)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 6)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.coopKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}


//// Editorial

public function showMaxIdEditorial()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 7)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 7)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.editorialKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdEditorial($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 7)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 7)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.editorialKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}


//// Web

public function showMaxIdWeb()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 8)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 8)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.webKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdWeb($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 8)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 8)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.webKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}

////video

public function showMaxIdVideo()
{

    $kpiScores = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 9)->get();


    $maxSum = 0;
    $maxIds = [];

    foreach ($kpiScores as $kpiScore) {
        $sum = $kpiScore->jan + $kpiScore->feb + $kpiScore->march + $kpiScore->april + $kpiScore->may + $kpiScore->june + $kpiScore->july + $kpiScore->aug + $kpiScore->sep + $kpiScore->oct + $kpiScore->nov + $kpiScore->dec;

        if ($sum > $maxSum) {
            $maxSum = $sum;
            $maxIds = [$kpiScore->id];
        } elseif ($sum == $maxSum) {
            $maxIds[] = $kpiScore->id;
        }
        $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 9)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday'
                    )
                    ->get();

    }
    return view('pillar_members.videoKpiMax', ['kpisdatas' => $kpisdatas]);
}
public function showMonthlyMaxIdVideo($month)
{
$column = strtolower($month);
$maxKpiScore = DB::table('k_p_i__scores')
    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
    ->where('pillar_members.pillar', 9)->max('k_p_i__scores.'.$column);


$kpiScores = KpiScore::all();
$maxIds = [];
foreach ($kpiScores as $kpiScore) {
    $kpi = $kpiScore-> $column ;
    if ($maxKpiScore==$kpi) {
        $maxIds[] = $kpiScore->id;
    }
    $kpisdatas = DB::table('k_p_i__scores')
                    ->join('pillar_members', 'k_p_i__scores.id', '=', 'pillar_members.id')
                    ->where('pillar_members.pillar', 9)

                    ->whereIn('pillar_members.id',$maxIds)
                    ->select(
                        'k_p_i__scores.id',
                        'pillar_members.first_name',
                        'pillar_members.last_name',
                        'pillar_members.email',
                        'pillar_members.nearest_town',
                        'pillar_members.contact_number',
                        'pillar_members.facebook_url',
                        'pillar_members.instagram_url',
                        'pillar_members.birthday',
                    )
                    ->get();
}
return view('pillar_members.videoKpiMonthlyMax')->with('kpisdatas', $kpisdatas);
}

}
