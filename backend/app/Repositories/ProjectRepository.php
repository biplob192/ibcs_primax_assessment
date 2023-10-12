<?php

namespace App\Repositories;

use Exception;
use App\Models\Project;
use App\Models\ProjectTask;
use Illuminate\Support\Facades\DB;
use App\Interfaces\ProjectRepositoryInterface;

class ProjectRepository implements ProjectRepositoryInterface
{
    public function index()
    {
        $projects = Project::latest()->get();
        return ['data' => $projects, 'message' => 'All project data.', 'status' => 200];
    }


    public function getData($request)
    {
        // Define the default page and perPage values
        $page           = $request->input('page', 1);
        $perPage        = $request->input('perPage', 10);
        $searchValue    = $request->input('search');
        $orderBy        = 'id';
        $order          = 'desc';

        if ($request->input('perPage') == 'All') {
        }

        $primaryQuery = Project::query()
            ->when($searchValue, function ($query, $searchValue) {
                $query->where(function ($query) use ($searchValue) {
                    $query->where('title', 'like', '%' . $searchValue . '%')
                        ->orWhere('description', 'like', '%' . $searchValue . '%');
                });
            });

        // Check if $perPage is numeric or 'all'
        if ($perPage != -1 && is_numeric($perPage)) {
            $offset = ($page - 1) * $perPage;
            $primaryQuery->offset($offset)->limit($perPage);
        }

        $fialData = $primaryQuery->orderBy($orderBy, $order)->get();

        // Get the total count of items (for pagination)
        $totalData = Project::count(); // You can optimize this query if needed
        return ['data' => ['data' => $fialData, 'total' => $totalData, 'request' => $request->all()], 'message' => 'All project data.', 'status' => 200];
    }


    public function store($request)
    {
        // Create new project
        $project                = new Project();
        $project->title         = $request->title;
        $project->description   = $request->description;
        $project->start_date    = $request->start_date;
        $project->end_date      = $request->end_date;
        $project->save();

        DB::commit();
        return ['data' => $project, 'message' => 'New project added successfully.', 'status' => 201];
    }

    public function storeProjectTasks($request)
    {
        // Create new projectTask
        $projectTask                = new ProjectTask();
        $projectTask->project_id    = $request->project_id;
        $projectTask->title         = $request->title;
        $projectTask->save();

        DB::commit();
        return ['data' => $projectTask, 'message' => 'New project task added successfully.', 'status' => 201];
    }


    public function show($id)
    {
        if (!$project = Project::with(['projectTask'])->find($id)) {
            throw new Exception("No record found.", 404);
        }

        return ['data' => $project, 'message' => 'Single project data.', 'status' => 200];
    }

    public function getProjectTasks($id)
    {
        if (!$projectTasks = ProjectTask::where('project_id', $id)->latest()->get()) {
            throw new Exception("No record found.", 404);
        }

        return ['data' => $projectTasks, 'message' => 'Project task data.', 'status' => 200];
    }


    public function update($request, $id)
    {
        if (!$project = Project::find($id)) {
            throw new Exception("No record found.", 404);
        }

        if ($request->title) {
            $project->title   = $request->title;
        }
        if ($request->description) {
            $project->description   = $request->description;
        }
        if ($request->start_date) {
            $project->start_date   = $request->start_date;
        }
        if ($request->end_date) {
            $project->end_date   = $request->end_date;
        }
        $project->save();

        DB::commit();
        return ['data' => $project, 'message' => 'Project updated successfully.', 'status' => 200];
    }


    public function destroy($id)
    {
        if (!Project::find($id)?->delete()) {
            throw new Exception("No record found.", 404);
        }

        return ['data' => '', 'message' => 'Project deleted successfully.', 'status' => 200];
    }
}
