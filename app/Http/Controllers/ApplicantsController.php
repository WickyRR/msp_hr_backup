<?php

namespace App\Http\Controllers;

use App\Models\Applicants;
use App\Models\Pillar;
use App\Models\RecruitProcess;
use App\Models\Skill;
use Illuminate\Http\Request;
use App\Models\Faculty;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ApplicantsController extends Controller
{
    public function index()
    {
        $recruit_process = RecruitProcess::where('process_status', 1)->first();
        $current_datetime = date(now());
        if ($recruit_process == null) {
            return abort(404);
        } else {
            if ($recruit_process->start_date <= $current_datetime && $recruit_process->close_date >= $current_datetime) {
                return view('applicants.index', [
                    'faculty' => Faculty::all(), 'pillars' => Pillar::all(),
                    'skills' => Skill::all(), 'recruit_process' => $recruit_process
                ]);
            } elseif ($recruit_process->close_date < $current_datetime) {
                $msg = "The recruitment process has ended on " . $recruit_process->close_date;
                return view('applicants.custom-message', [
                    'custom_message' => $msg, 'recruit_process' => $recruit_process,
                    'page_title' => 'Recruitment Process Ended'
                ]);
            } else {
                $msg = "The recruitment process will start on " . $recruit_process->start_date;
                return view('applicants.custom-message', [
                    'custom_message' => $msg, 'recruit_process' => $recruit_process,
                    'page_title' => 'Recruitment Process Not Yet Started'
                ]);
            }
        }
    }

    public function store()
    {
        $recruit_process = RecruitProcess::where('process_status', 1)->first();
        $current_datetime = date(now());
        if ($recruit_process == null) {
            return abort(404);
        } else {
            if ($recruit_process->close_date < $current_datetime or $recruit_process->start_date > $current_datetime) {
                return abort(404);
            }
        }
        $data = request()->validate([
            'full_name' => ['required', 'string', 'max:150'],
            'name' => ['required', 'string', 'max:100'],
            'index_no' => ['nullable', 'max:10', 'string'],
            'email' => ['required', 'string', 'email', 'max:50'],
            'contact_no' => ['required', 'max:15', 'string'],
            'faculty' => ['required', 'integer'],
            'department' => ['required', 'string', 'max:50'],
            'batch' => ['required', 'integer'],
            'prev_member' => ['required', 'in:0,1'],
            'projects' => ['string', 'nullable'],
            'sports_do' => ['string', 'nullable'],
            'pillars' => ['required'],
            'skills' => ['required'],
            'clubs' => ['string', 'nullable'],
            'achievements' => ['string', 'nullable'],
            'cv' => ['file', 'required', 'mimes:pdf,zip', 'max:10240'],
            'driveLink' => ['string', 'nullable']
        ]);

        $recruit = Applicants::where('email', $data['email'])->where('index_no', $data['index_no'])->first();
        if ($recruit == null) {
            $recruit = new Applicants;
        } else {
            //Storage::delete('privatefiles/'.$recruit->cv);
            Storage::disk('s3')->delete($recruit->cv);
        }
        //$cvPath=request('cv')->store('cv/'.$recruit_process->recruit_process_id, 'privateFiles');
        $cvPath = Storage::disk('s3')->putFile('cv/' . $recruit_process->recruit_process_id, request('cv'));
        $recruit->full_name = $data['full_name'];
        $recruit->name = $data['name'];
        $recruit->index_no = $data['index_no'];
        $recruit->email = $data['email'];
        $recruit->contact_no = $data['contact_no'];
        $recruit->fac_id = $data['faculty'];
        $recruit->department = $data['department'];
        $recruit->batch = $data['batch'];
        $recruit->is_old_member = $data['prev_member'];
        $recruit->prev_projects = $data['projects'];
        $recruit->sports_do = $data['sports_do'];
        $recruit->drive_link = $data['driveLink'];
        $recruit->clubs = $data['clubs'];
        $recruit->achievements = $data['achievements'];
        $recruit->cv = $cvPath;
        $recruit->apply_status = 0;
        $recruit->process_id = $recruit_process->recruit_process_id;

        DB::beginTransaction();
        try {
            $recruit->save();
            $recruit = Applicants::find($recruit->recruit_id);
            $recruit->pillars()->sync($data['pillars']);
            $recruit->skills()->sync($data['skills']);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            //Storage::delete('privatefiles/'.$recruit->cv);
            Storage::disk('s3')->delete($recruit->cv);
            return redirect()->back()->withInput()->withErrors(['db_ins_fail' => 'Invalid input found. Please contact us if this error continues.']);
        }
        return redirect()->route('apply.success');
    }

    public function success()
    {
        $recruit_process = RecruitProcess::where('process_status', 1)->first();
        $msg = "Application received successfully.";
        return view('applicants.custom-message', [
            'custom_message' => $msg, 'recruit_process' => $recruit_process,
            'page_title' => 'Application Successful'
        ]);
    }

    public function downloadCSV($process_id)
    {
        //Retriving data and cleaning and reformatting
        $data = Applicants::with(['faculty', 'pillars', 'skills'])
            ->where('process_id', '=', $process_id)
            ->get();
        $excelColumns = [
            'Recruit ID', 'Recruit Full Name', 'Recruit Name', 'Index No', 'Email', 'Contact No', 'Department', 'Faculty',
            'Batch', 'Is an Old Member?', 'Previous Projects as a Member', 'Sports Involved',
            'Applied Pillars', 'Skills', 'Drive Link', 'Clubs', 'Achivements', 'CV', 'Apply Status', 'Application Submitted Time'
        ];
        $cleanedData = [$excelColumns];
        foreach ($data as $applicant) {
            switch ($applicant->apply_status) {
                case 0:
                    $apply_status = "Applied";
                    break;
                case 1:
                    $apply_status = "Rejected";
                    break;
                case 1:
                    $apply_status = "Recruited";
                    break;
                default:
                    $apply_status = "Unknown";
            }
            $skills = "";
            $pillars = "";
            foreach ($applicant->skills as $skill) {
                $skills .= $skill->skill_name . ', ';
            }
            foreach ($applicant->pillars as $pillar) {
                $pillars .= $pillar->pillar_name . ', ';
            }
            $skills = rtrim($skills, " ,");
            $pillars = rtrim($pillars, " ,");
            $row = [
                $applicant->recruit_id, $applicant->full_name, $applicant->name, $applicant->index_no, $applicant->email, $applicant->contact_no,
                $applicant->department, $applicant->faculty->fac_name,
                'Batch ' . $applicant->batch, $applicant->is_old_member == 0 ? 'No' : 'Yes',
                $applicant->prev_projects, $applicant->sports_do,
                $pillars, $skills,
                $applicant->drive_link,
                $applicant->clubs, $applicant->achievements,
                URL::to('/') . '/applicants/cv/download/' . $applicant->recruit_id,
                $apply_status, $applicant->timestamp
            ];
            array_push($cleanedData, $row);
        }

        //File generation section
        $fileName = "ApplicantsList-Process-" . $process_id . "-" . strtotime("now") . ".csv";
        $headers = [
            'Cache-Control'       => 'must-revalidate, post-check=0, pre-check=0',   'Content-type'        => 'text/csv',   'Content-Disposition' => 'attachment; filename=' . $fileName,   'Expires'             => '0',   'Pragma'              => 'public'
        ];

        $callback = function () use ($cleanedData) {
            $FH = fopen('php://output', 'w');
            foreach ($cleanedData as $row) {
                fputcsv($FH, $row);
            }
            fclose($FH);
        };
        //return (new StreamedResponse($callback, 200, $headers))->sendContent();
        return response()->streamDownload($callback, $fileName, $headers);
    }



    //loading data into table
    public function view()
    {
        $users = DB::table('recruit')
            ->join('faculty', 'faculty.fac_id', '=', 'recruit.fac_id')
            ->join('recruit_processes', 'recruit_processes.recruit_process_id', '=', 'recruit.process_id')
            ->select('recruit.recruit_id', 'recruit.name', 'faculty.fac_name', 'recruit.department', 'recruit.batch', 'recruit.apply_status')
            ->get();

        $fac = Faculty::all();
        $process = RecruitProcess::all();

        return view('pages.members', ['users' => $users, 'facs' => $fac, 'processes' => $process]);
    }

    //filtering data
    public function filter(Request $request)
    {
        $data = DB::table('recruit')
            ->join('faculty', 'faculty.fac_id', '=', 'recruit.fac_id')
            ->select('recruit.recruit_id', 'recruit.name', 'faculty.fac_name', 'recruit.department', 'recruit.batch', 'recruit.apply_status')
            ->where('process_id', $request->id)
            ->get();

        return view('pages.members', ['users' => $data]);
    }
}
