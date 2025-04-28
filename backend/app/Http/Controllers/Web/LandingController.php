<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Http\Resources\BiodataFrontResource;
use App\Http\Resources\BlogFrontResource;
use App\Http\Resources\ProjectFrontResource;
use App\Models\Biodata;
use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Project;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function landing()
    {

        $biodata = Biodata::first();
        $projects = Project::query()
            ->select(['id', 'slug', 'title', 'description',  'start_date', 'end_date', 'thumbnail', 'website_link', 'github_link'])
            ->with('skills')->where('is_featured', 1)->take(4)->orderBy('start_date', 'desc')->get();
        $blogs = Blog::query()
            ->select(['id', 'title', 'description', 'content', 'thumbnail', 'slug', 'blog_category_id'])->with('blogCategory')->where('is_show', 1)->where('is_featured', 1)->take(6)->latest()->get();



        return inertia('Landing', [
            'page_data' => [
                'biodata' => new BiodataFrontResource($biodata),
                'projects' => ProjectFrontResource::collection($projects),
                'blogs' => BlogFrontResource::collection($blogs),
            ]
        ]);
    }
}
