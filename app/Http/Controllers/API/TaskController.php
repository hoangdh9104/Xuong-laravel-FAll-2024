<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Task::latest('id')->paginate(5);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'task_name'     => 'required',
            'description'   => 'required',
            'status'        => 'required',
            'project_id'    => 'required',
        ]);

        $task = Task::query()->create($data);

        return response()->json([
            'message' => 'Nhiệm vụ được tạo thành công',
            'task' => $task,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $projectId, string $taskId)
    {
        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();

        return response()->json($task, 200);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $projectId, string $taskId)
    {
        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();
        $data = $request->validate([
            'status'    => 'required',
        ]);

        $task->update($data);

        return response()->json([
            'message' => 'Nhiệm vụ được cập nhật',
            'task' => $task,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $projectId, string $taskId)
    {
        $task = Task::where('id', $taskId)
            ->where('project_id', $projectId)
            ->first();

        $task->delete();

        return response()->json([
            'message' => 'Nhiệm vụ đã được xóa',
            'task' => $task,
        ], 200);
    }
    public function getTask($projectId)
    {

        $project = Project::find($projectId);
        if (!$project) {
            return response()->json(['message' => 'Dự án không tồn tại'], 404);
        }


        $tasks = $project->tasks;


        return response()->json([
            'message' => 'Danh sách nhiệm vụ của dự án',
            'tasks' => $tasks
        ]);
    }
}
