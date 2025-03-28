<?php

namespace App\Http\Controllers;
use App\Models\Gallery;     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where('title', 'LIKE', "%{$search}%")
                ->orWhere('description', 'LIKE', "%{$search}%")
                ->orWhereHas('user', function ($userQuery) use ($search) {
                    $userQuery->where('name', 'LIKE', "%{$search}%");
                });
        }
        
        $galleries = $query->orderBy('created_at', 'asc')->get();
        
        return view('backend.galleries.main', compact('galleries'));
        
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name'       => 'required|string|max:255',
                'description' => 'required|string',
                'category'    => 'required|string|in:Penyuntikan Anti Rayap Kusen Jendela,Penyuntikan Anti Rayap Kusen Pintu,Penyuntikan Anti Rayap Dinding Keramik Kamar Mandi,Penyuntikan Anti Rayap Lantai Dasar',
                'image'       => 'required|file|max:2048',
            ]);

            $filePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $filePath = $file->store('galleries', 'public');
            }

            Gallery ::create([
                'name'       => $validated['name'],
                'category'    => $validated['category'],
                'description' => $validated['description'],
                'image_url'  => $filePath,
            ]);

            DB::commit();

            return redirect()->route('galleries.index')->with('success', 'Gallery created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating blog: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while creating the Gallery. Please try again later.')
                ->withInput();
        }
    }

    public function create()
    {
        return view('backend.galleries.create');
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Find the existing blog post
            $gallery = Gallery::findOrFail($id);

            // Validate input
            $validated = $request->validate([
                'name'       => 'string|max:255',
                'description' => 'required|string',
                'category'    => 'required|string|in:Penyuntikan Anti Rayap Kusen Jendela,Penyuntikan Anti Rayap Kusen Pintu,Penyuntikan Anti Rayap Dinding Keramik Kamar Mandi,Penyuntikan Anti Rayap Lantai Dasar',
                'image'       => 'file|max:2048', // Image is optional during update
            ]);

            $filePath = $gallery->image_url; // Retain current image path

            // Handle file upload if a new image is provided
            if ($request->hasFile('image')) {
                // Delete the old image if it exists
                if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
                    Storage::disk('public')->delete($gallery->image_url);
                }

                $file = $request->file('image');
                $filePath = $file->store('galleries', 'public'); // Save new image
            }

            // Update the blog post
            $gallery->update([
                'name'       => $validated['name'],
                'category'    => $validated['category'],
                'description' => $validated['description'],
                'image_url'   => $filePath,
            ]);

            DB::commit();

            return redirect()->route('galleries.index')->with('success', 'Gallery updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

                Log::error('Error updating Gallery: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating the Gallery. Please try again later.')
                ->withInput();  
        }
    }

    public function edit(string $id)
    {
        $gallery = Gallery::findOrFail($id);

        return view('backend.galleries.edit', compact('gallery'));
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try {
            $gallery = Gallery::findOrFail($id);

            // Delete the image if it exists
            if ($gallery->image_url && Storage::disk('public')->exists($gallery->image_url)) {
                Storage::disk('public')->delete($gallery->image_url);
            }

            $gallery->delete();

            DB::commit();

            return redirect()->route('galleries.index')->with('success', 'Gallery deleted successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error deleting Gallery: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while deleting the Gallery. Please try again later.');
        }
    }
}
