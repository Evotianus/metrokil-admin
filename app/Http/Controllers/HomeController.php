<?php


namespace App\Http\Controllers;

use App\Models\Gallery;  
use App\Models\Service;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        // Hitung data dari tiap tabel
        $galleryCount = Gallery::count();
        $serviceCount = Service::count();
        $blogCount = Blog::count();
        $testimonialCount = Testimonial::count();

        $query = Blog::query();

        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', "%{$search}%");
                });
        }

        $blogs = $query->orderBy('created_at', 'desc')->get();
        $blogs = Blog::paginate(3);

        // return ke view dengan data
        return view('backend.home.main', compact(
            'galleryCount',
            'serviceCount',
            'blogCount',
            'testimonialCount',
            'blogs'
        ));
    }
}
