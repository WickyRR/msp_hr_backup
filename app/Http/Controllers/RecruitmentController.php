<?php

namespace App\Http\Controllers;

use App\Models\ActiveYear;
use Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\RecruitProcess;

class RecruitmentController extends Controller
{
    //
    public function add()
    {
        $activeYears = ActiveYear::all();
        return view('recruitments.recruitmentAdd', ['active_years_list' => $activeYears]);
    }

    public function store(Request $request)
    {
        $task = new RecruitProcess;

        $this->validate($request, [
            'process_name' => ['string', 'required', 'max:38'],
            'contacts' => ['string', 'required'],
            'year' => ['int', 'required'],
            'start_date' => ['date', 'required'],
            'close_date' => ['date', 'required'],
            'process_status' => ['in:0,1', 'required'],
            'instructions' => ['string', 'required'],
        ]);

        $task->process_name = $request->process_name;
        $task->instructions = $request->instructions;
        $task->contact_details = $request->contacts;
        $task->year_id = $request->year;
        $task->start_date = $request->start_date;
        $task->close_date = $request->close_date;
        $task->process_status = $request->process_status;

        if ($request->process_status == '1') {
            RecruitProcess::where('process_status', 1)->update(['process_status' => 0]);
        }

        $task->save();
        return redirect()->route('recruitment.add');
    }

    public function view()
    {
        $activeYears = ActiveYear::all();
        $recruit_processes = RecruitProcess::with(['activeYear'])->latest()->get();
        return view(
            'recruitments.recruitmentView',
            ['active_years_list' => $activeYears, 'recruit_process_list' => $recruit_processes]
        );
    }


    public function getRecruitmentById(Request $request)
    {
        $task = RecruitProcess::find($request->id);
        if ($task != null) {
            return response()->json(['status' => '200', 'message' => 'Found Recruitment', 'data' => $task]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such Recruitment in database',]);
        }
    }


    public function updateRecruitment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'pname' => ['string', 'required', 'max:38'],
            'instructions' => ['string', 'required'],
            'contacts' => ['string', 'required'],
            'year' => ['int', 'required'],
            'sdate' => ['date', 'required'],
            'cdate' => ['date', 'required'],
            'status' => ['in:0,1', 'required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '422', 'message' => 'Data validation failed.', 'error' => $validator->errors(),]);
        }

        try {
            $task = RecruitProcess::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => '204', 'message' => 'No such Recruitment in database',]);
        }

        $task->process_name = $request->pname;
        $task->instructions = $request->instructions;
        $task->contact_details = $request->contacts;
        $task->year_id = $request->year;
        $task->start_date = $request->sdate;
        $task->close_date = $request->cdate;
        $task->process_status = $request->status;

        if ($request->status == '1') {
            RecruitProcess::where('process_status', 1)->update(['process_status' => 0]);
        }

        $task->save();
        return response()->json(['status' => '200', 'message' => 'Recruitment updated.', 'data' => $task]);
    }

    public function deleteRecruitment(Request $request)
    {
        $task = RecruitProcess::find($request->id);
        if ($task != null) {
            $task->delete();
            return response()->json(['status' => '200', 'message' => 'Recruitment successfully deleted.', 'data' => $task]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such Recruitment in database',]);
        }
    }
}
