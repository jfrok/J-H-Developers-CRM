<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Hours;
use App\Models\Logbook;
use App\Models\Project;
use App\Models\WorkOrder;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectsController extends Controller
{

    public function logAdd($title, $id, $type, $description)
    {
        $log = new Logbook();
        $log->user_id = Auth::id();
        $log->title = $title;
        $log->type = $type;
        $log->id_of = $id;
        $log->description = $description;
        $log->save();
    }

    public function ProjectsOverview()
    {
        $projects = Project::all();
        $customers = Customer::all();
        return view('projects.projects-overview', compact('projects', 'customers'));
    }

    public function Project()
    {
        $customers = Customer::all();
        return view('projects.projects', compact('customers'));
    }

    public function details($pId)
    {
        $project = Project::find($pId);
        $customer = Customer::find($project->customer_id);
        $customers = Customer::all();
        $workedHours = Hours::where('project_id', $project->id)->get();

//        $chartData = [
//            'AgreedHours' => number_format($project->set_price * $project->set_hours, 2, '.', ''),
//            'WorkedHours' => number_format($project->getWorkedHours() * $project->set_price, 2, '.', '')
//        ];
        $chartData = [
            'AgreedHours' => number_format($project->set_hours, 2, '.', ''),
            'WorkedHours' => number_format($project->getWorkedHours(), 2, '.', ''),
            'AgreedPrice' => number_format($project->set_price * $project->set_hours, 2, '.', ''),
            'WorkedPrice' => number_format($project->getWorkedHours() * $project->set_price, 2, '.', '')
        ];
        return view('projects.project-details', compact('project', 'customer', 'workedHours', 'chartData', 'customers'));
    }

    public function addProject(Request $request)
    {
        $new = new Project();
        $new->customer_id = $request->customer_id;
        $new->title = $request->title;
        $new->description = $request->description;
        $new->set_hours = $request->set_hours;
        $new->set_price = $request->set_price;

        $new->save();
        $this->logAdd($new->title, $new->id, 'add', 'Project');

        return response()->json();
    }

    public function editProject($pId)
    {
        $project = Project::find($pId);
//$data = view('projects.projects-overview',compact('project'));
        return response()->json([
            'status' => 200,
            'project' => $project,

        ]);
    }

    public function saveProject($pId, Request $request)
    {
        $edit = Project::find($pId);
        $edit->title = $request->edit_title;
        $edit->set_hours = $request->set_hours;
        $edit->set_price = $request->set_price;
        $edit->customer_id = $request->customer_id;
        $edit->description = $request->description_edit;
        $edit->status = $request->status;

        $edit->save();
        $this->logAdd($edit->title, $edit->id, 'edit', 'Project');

        return response()->json();
    }

    public function getProjectRequest()
    {
        $projects = Project::all();
        $data = view('includes.projects-table', compact('projects'))->render();
        return response()->json($data);
    }

    public function projectDelete($pId)
    {
        Project::find($pId)->delete();
    }
}
