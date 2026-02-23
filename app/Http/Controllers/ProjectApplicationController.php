<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectApplication;
use Illuminate\Http\Request;

class ProjectApplicationController extends Controller
{
    public function store(Request $request, $slug)
    {
        $project = Project::where('slug', $slug)
            ->where('is_active', true)
            ->where('allow_applications', true)
            ->firstOrFail();

        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:50',
            'message' => 'nullable|string|max:2000',
        ]);

        ProjectApplication::create(array_merge($validated, ['project_id' => $project->id]));

        return response()->json([
            'message' => 'Your application has been submitted successfully! We will be in touch.'
        ]);
    }
}
