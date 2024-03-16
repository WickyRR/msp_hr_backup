<?php

namespace App\Http\Controllers;

use App\Models\ActiveYear;
use App\Models\PillarMember;
use App\Models\Project;
use App\Models\ProjectCrew;
use App\Models\RecruitProcess;
use mysql_xdevapi\Exception;
use \Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use App\Models\Pillar;
use App\Models\ProjectRole;
use function PHPUnit\Framework\returnArgument;


class ProjectController extends Controller
{
    //
    public function add()
    {
        $pills = Pillar::all();
        return view('projects.projectsAdd', ['pills' => $pills]);
    }


    public function store(Request $request)
    {
        $task = new Project();

        try {
            $this->validate($request, [
                'project_name' => ['string', 'required'],
                'project_description' => ['string', 'required'],
                'pillar' => ['int', 'required'],
                'start_date' => ['date', 'required'],
                'end_date' => ['date', 'required'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => '422', 'message' => 'Data validation failed.', 'error' => $e,]);
        }

        $task->project_name = $request->project_name;
        $task->project_description = html_entity_decode($request->project_description);
        $task->project_description = strip_tags($task->project_description);
        $task->pillar_id = $request->pillar;
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->project_status = 1;

        $task->save();
        return redirect()->route('projects.add');
    }

    public function view()
    {
        $projects = Project::with([])->latest()->get();
        $pills = Pillar::all();
        $pillar_members = PillarMember::all();
        $roles = ProjectRole::all();
        $crew = ProjectCrew::all();
        return view(
            'projects.projectsView',
            ['project_list' => $projects, 'pills' => $pills, 'pillar_members' => $pillar_members, 'roles' => $roles, 'crew' => $crew]
        );
    }


    public function getProjectById(Request $request)
    {
        $task = Project::find($request->id);
        if ($task != null) {
            return response()->json(['status' => '200', 'message' => 'Found Project', 'data' => $task]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such project in database',]);
        }
    }


    public function updateProject(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'project_name' => ['string', 'required'],
            'project_description' => ['string', 'required'],
            'start_date' => ['date', 'required'],
            'end_date' => ['date', 'required'],
            'project_status' => ['int', 'required'],
            'pillar' => ['int', 'required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '422', 'message' => 'Data validation failed.', 'error' => $validator->errors(),]);
        }

        try {
            $task = Project::findOrFail($request->id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => '204', 'message' => 'No such Project in database',]);
        }

        $task->project_name = $request->project_name;
        $task->project_description = html_entity_decode($request->project_description);
        $task->project_description = strip_tags($task->project_description);
        $task->start_date = $request->start_date;
        $task->end_date = $request->end_date;
        $task->project_status = $request->project_status;
        $task->pillar_id = $request->pillar;

        /*if ($request->status == '1') {
            Project::where('id', 1)->update(['project_status' => 0]);
        }*/

        $task->save();
        return response()->json(['status' => '200', 'message' => 'Project updated.', 'data' => $task]);
    }

    public function deleteProject(Request $request)
    {
        $task = Project::find($request->id);
        if ($task != null) {
            $task->delete();
            $task2 = ProjectCrew::where('project',$request->id);
            $task2->delete();
            return response()->json(['status' => '200', 'message' => 'Project successfully deleted.', 'data' => $task]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such Project in database',]);
        }
    }

    public function projectRoles()
    {
        $roles = ProjectRole::all();
        return view(
            'projects.projectsRoles',
            ['roles' => $roles]
        );
    }

    public function projectRolesAdd(Request $request)
    {
        $task = new ProjectRole();

        $this->validate($request, [
            'role_name' => ['string', 'required'],
        ]);

        $task->role = $request->role_name;

        $task->save();
        return redirect()->route('projects.roles');
    }

    public function projectRolesGetByID(Request $request)
    {
        $task = ProjectRole::find($request->id);
        if ($task != null) {
            return response()->json(['status' => '200', 'message' => 'Found Role', 'data' => $task]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such role in database',]);
        }
    }

    public function projectRoleUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'edit_role_name' => ['string', 'required'],
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => '422', 'message' => 'Data validation failed.', 'error' => $validator->errors(),]);
        }

        try {
            $task = ProjectRole::findOrFail($request->edit_role_id);
        } catch (ModelNotFoundException $exception) {
            return response()->json(['status' => '204', 'message' => 'No such role in database',]);
        }

        $task->role = $request->edit_role_name;

        $task->save();
        return response()->json(['status' => '200', 'message' => 'Role updated.', 'data' => $task]);
    }

    public function deleteRole(Request $request)
    {
        $task = ProjectRole::find($request->id);
        if ($task != null) {
            $task->delete();
            return response()->json(['status' => '200', 'message' => 'Crew role successfully deleted.', 'data' => $task]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such crew role in database']);
        }
    }

    public function projectCrewGetByID2(Request $request)
    {
        $task2 = $this->projectCrewGetByID($request->id);
        return response()->json($task2);
    }

    public function projectCrewGetByID($id)
    {
        $crew = ProjectCrew::where('project', $id)->get();
        $pillars = Pillar::all();
        $member_id = "";
        $member_name = "";
        $pillar_name = "";
        //$member_role = "";
        $json_data = "[";
        $firstOne = '1';

        if ($crew != null) {
            $pillar_members = PillarMember::all();
            //$roles = ProjectRole::all();
            foreach ($crew as $crew_member) {
                foreach ($pillar_members as $member) {
                    if ($crew_member->member == $member->id) {
                        $member_id = $crew_member->id;
                        $member_name = $member->first_name . " " . $member->last_name;
                        foreach ($pillars as $pill){
                            if($member->pillar == $pill->pillar_id){
                                $pillar_name = $pill->pillar_name;
                            }
                        }

                    }
                }

                /*foreach ($roles as $role) {
                    if ($crew_member->role == $role->id) {
                        $member_role = $role->role;
                    }
                }*/

                if ($firstOne == 0) {
                    $json_data = $json_data . ", {\"ID\": \"" . $member_id . "\", \"NAME\": \"" . $member_name . "\", \"PILLAR\": \"".$pillar_name. "\"}";
                } else {
                    $json_data = $json_data . "{\"ID\": \"" . $member_id . "\", \"NAME\": \"" . $member_name . "\", \"PILLAR\": \"".$pillar_name. "\"}";
                    $firstOne = 0;
                }

            }

            $json_data = $json_data . "]";
            return response()->json($json_data);
        } else {
            return response()->json(['status' => '204', 'message' => 'No any crew members in database']);
        }
    }

    public function projectCrewAdd(Request $request)
    {
        $task = new ProjectCrew();

        try {
            $this->validate($request, [
                'crew_projectid' => ['string', 'required'],
                'pillar_member' => ['string', 'required'],
                //'member_roles' => ['int', 'required'],
            ]);
        } catch (ValidationException $e) {
            return response()->json(['status' => '422', 'message' => 'Data validation failed.', 'error' => $e,]);
        }

        $task->member = $request->pillar_member;
        $task->project = $request->crew_projectid;
        //$task->role = $request->member_roles;

        $task3 = ProjectCrew::where('member', $task->member)->where('project', $task->project)->get();
        if ($task3 == "[]") {
            $task->save();
            $task2 = $this->projectCrewGetByID($request->crew_projectid);
            return response()->json(['status' => '200', 'message' => 'Data update successful.', 'data' => $task2]);
        } else {
            $task2 = $this->projectCrewGetByID($request->crew_projectid);
            return response()->json(['status' => '409', 'message' => 'This member is already added', 'data' => $task2]);
        }
    }

    public function deleteCrewMember(Request $request)
    {
        $task = ProjectCrew::find($request->id);
        if ($task != null) {
            $task->delete();
            $task2 = $this->projectCrewGetByID($request->project_id);
            return response()->json(['status' => '200', 'message' => 'Data update successful.', 'data' => $task2]);
        } else {
            return response()->json(['status' => '204', 'message' => 'No such crew member in database']);
        }
    }

    public function getPillarMembersByID(Request $request)
    {
        $matchingMembers = PillarMember::where('pillar', $request->id)->get();
        //$matchingMembers = PillarMember::all();

        $json_data = "[";

        $firstOne = 1;
        if ($matchingMembers != null) {
            foreach ($matchingMembers as $matchingMember) {
                if ($firstOne == 0) {
                    $json_data = $json_data . ", {\"ID\": \"" . $matchingMember->id . "\", \"NAME\": \"" . $matchingMember->first_name . " " . $matchingMember->last_name . "\"}";
                } else {
                    $json_data = $json_data . "{\"ID\": \"" . $matchingMember->id . "\", \"NAME\": \"" . $matchingMember->first_name . " " . $matchingMember->last_name . "\"}";
                    $firstOne = 0;
                }
            }

            $json_data = $json_data . "]";
            return response()->json($json_data);
        } else {
            return response()->json(['status' => '204', 'message' => 'No any pillar members in database']);
        }
    }
}
