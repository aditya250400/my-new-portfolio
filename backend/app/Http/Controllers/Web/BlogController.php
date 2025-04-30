<?php

namespace App\Http\Controllers\Web;

use App\Filament\Resources\BiodataResource;
use App\Filament\Resources\BlogResource;
use App\Http\Controllers\Controller;
use App\Http\Resources\BiodataFrontResource;
use App\Http\Resources\BlogCategoryResource;
use App\Http\Resources\BlogFrontResource;
use App\Models\Biodata;
use App\Models\Blog;
use App\Models\BlogCategory;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $all_blogs = Blog::query()
            ->select(['id', 'title', 'description', 'content', 'thumbnail', 'slug', 'blog_category_id', 'created_at'])->with('blogCategory')->where('is_show', 1)->take(3)->latest()->get();

        $categories = BlogCategory::whereHas('blogs')->with(['blogs' => fn($query) => $query->limit(4)])->latest()->inRandomOrder()->get();



        return inertia('Web/Blogs/Index', [
            'page_data' => [
                'all_blogs' => BlogFrontResource::collection($all_blogs),
                'categories' => BlogCategoryResource::collection($categories),
            ]
        ]);
    }

    public function all()
    {
        $blogs = Blog::query()
            ->select(['id', 'title', 'description', 'content', 'thumbnail', 'slug', 'blog_category_id', 'created_at'])->with('blogCategory')->where('is_show', 1)->latest()->get();



        return inertia('Web/Blogs/All', [
            'page_data' => [
                'blogs' => BlogFrontResource::collection($blogs),
            ]
        ]);
    }

    public function show(Blog $blog)
    {
        $blog->load('blogCategory');

        $other_blogs = Blog::with('blogCategory')->where('id', '!=', $blog->id)->inRandomOrder()->take(5)->get();
        $other_category_blogs = BlogCategory::with(['blogs' => fn($query) => $query->where('id', '!=', $blog->id)])->where('id', $blog->blogCategory->id)->inRandomOrder()->take(5)->first();

        $biodata = Biodata::first();

        return inertia('Web/Blogs/Show', [
            'page_data' => [
                'biodata' => new BiodataFrontResource($biodata),
                'blog' => new BlogFrontResource($blog),
                'other_blogs' => BlogFrontResource::collection($other_blogs),
                'other_category_blogs' => new BlogCategoryResource($other_category_blogs),
            ]
        ]);
    }

    public function category(BlogCategory $blogCategory)
    {
        $blogCategory->load('blogs');



        return inertia('Web/Blogs/Category', [
            'page_data' => [
                'category' =>  new BlogCategoryResource($blogCategory)
            ],
        ]);
    }

    public function search(Request $request)
    {
        $request->validate(['keyword' => 'required|string|max:255']);


        $keyword = $request->keyword;

        $blogs = Blog::with('blogCategory')->where('title', 'like', '%' . $keyword . '%')->get();

        return inertia('Web/Blogs/Search', [
            'page_data' => [
                'blogs' => BlogFrontResource::collection($blogs),
                'keyword' => $keyword
            ]
        ]);
    }
}
