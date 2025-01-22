<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
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

        return view('backend.blogs.main', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.blogs.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'required|string',
                'category'    => 'required|string|in:news,information',
                'image'       => 'required|file|max:2048',
            ]);

            $filePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('blogs', 'public');
            }

            Blog::create([
                'title'       => $validated['title'],
                'category'    => $validated['category'],
                'description' => $validated['description'],
                'image_url'  => $filePath,
                'user_id'     => auth()->id(),
            ]);

            DB::commit();

            return redirect()->route('blogs.index')->with('success', 'Blog created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating blog: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while creating the blog. Please try again later.')
                ->withInput();
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);

        return view('backend.blogs.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();

        try {
            // Find the existing blog post
            $blog = Blog::findOrFail($id);

            // Validate input
            $validated = $request->validate([
                'title'       => 'required|string|max:255',
                'description' => 'required|string',
                'category'    => 'required|string|in:news,information',
                'image'       => 'nullable|file|max:2048', // Image is optional during update
            ]);

            $filePath = $blog->image_url; // Retain current image path

            // Handle file upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($blog->image_url && Storage::disk('public')->exists($blog->image_url)) {
                    Storage::disk('public')->delete($blog->image_url);
                }

                $file = $request->file('image');
                $filePath = $file->store('blogs', 'public'); // Save new image
            }

            // Update the blog post
            $blog->update([
                'title'       => $validated['title'],
                'category'    => $validated['category'],
                'description' => $validated['description'],
                'image_url'   => $filePath,
            ]);

            DB::commit();

            return redirect()->route('blogs.index')->with('success', 'Blog updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error updating blog: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating the blog. Please try again later.')
                ->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            // Find the blog post
            $blog = Blog::findOrFail($id);

            // Delete the image if it exists
            if ($blog->image_url && Storage::disk('public')->exists($blog->image_url)) {
                Storage::disk('public')->delete($blog->image_url);
            }

            // Delete the blog post
            $blog->delete();

            DB::commit();

            return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error deleting blog: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting the blog. Please try again later.');
        }
    }
}
