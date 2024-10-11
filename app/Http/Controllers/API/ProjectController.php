<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Project::latest('id')->paginate(5);
        return response()->json($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'project_name' => ['required', 'max:255', Rule::unique('projects')],
            'description' => 'required',
            'start_date' => 'required|date',
        ]);


        $project = Project::query()->create($data);

        return response()->json([
            'message' => 'Dự án được tạo thành công',
            'project' => $project,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::find($id);

        return response()->json($project);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::find($id);
        $data = $request->validate([
            'project_name' => ['required', 'max:255', Rule::unique('projects')->ignore($project->id)],
            'description' => 'required',
            'start_date' => 'required|date',
        ]);

        $project->update($data);


        return response()->json([
            'message' => 'Dự án được update thành công',
            'project' => $project,
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::find($id);
        $project->delete();

        
        return response()->json([
            'message' => 'Dự án được xóa',
            // 'project' => $project,
        ], 200); 
    }
}
