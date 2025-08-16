<?php


namespace App\Http\Controllers;

use App\Models\Gallery;  
use App\Models\Service;
use App\Models\Blog;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // Hitung data dari tiap tabel
        $galleryCount = Gallery::count();
        $serviceCount = Service::count();
        $blogCount = Blog::count();

        // return ke view dengan data
        return view('backend.home.main', compact(
            'galleryCount',
            'serviceCount',
            'blogCount',
        ));
    }
}
