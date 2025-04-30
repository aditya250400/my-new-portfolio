<?php

namespace App\Http\Middleware;

use App\Models\Blog;
use App\Models\BlogCategory;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return [
            ...parent::share($request),
            'auth' => [
                'user' => $request->user(),
            ],
            'categories' => BlogCategory::whereHas('blogs')->take(5)->latest()->get(),
            'blogs' => Blog::take(5)->inRandomOrder()->latest()->get(),
            'projects' => Project::where('is_featured', 1)->whereNotNull('website_link')->take(5)->inRandomOrder()->latest()->get(),
        ];
    }
}
