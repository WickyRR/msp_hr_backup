<?php

namespace App\Http\Controllers;

use App\Models\Applicants;
use Illuminate\Http\Request;
use Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use DB;

class RecruitController extends Controller
{
    //deleting a row
    public function delete($id)
    {
        $member = DB::table('recruit')
            ->where('recruit_id', $id);

        if ($member != null) {
            $member->delete();
            return redirect('applicants')->with('status', 'Applicant Details deleted successfully');
        }
    }


    public function getById(Request $request)
    {
        $value = Applicants::find($request->id);
        if ($value != null) {
            return response()->json(['status' => '200', 'message' => 'Found Recruitment', 'data' => $value]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such Recruitment in database',]);
        }
    }

    public function updatenow(Request $request)
    {

        try {
            $value = Applicants::findorFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => '204', 'message' => 'No such Recruitment in database',]);
        }

        $value->name = $request->a_name;
        $value->fac_id = $request->a_faculty;
        $value->department = $request->a_department;
        $value->batch = $request->a_level;
        $value->apply_status = $request->a_status;

        $value->save();
        return response()->json(['status' => '200', 'message' => 'Data updated.', 'data' => $value]);
    }

    //deleting multiple rows
    public function deletechecked(Request $request)
    {
        $ids = $request->ids;

        DB::table('recruit')->whereIn('recruit_id', explode(",", $ids))->delete();
        return response()->json(['status' => true, 'message' => 'Applicant Details deleted successfully']);
    }
}
