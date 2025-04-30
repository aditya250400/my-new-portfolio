<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProjectFrontResource;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return inertia('Web/Projects/Index', [
            'page_data' => [
                'projects' => ProjectFrontResource::collection($projects),
            ]
        ]);
    }
}
