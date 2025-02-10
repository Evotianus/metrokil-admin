<?php

namespace App\Http\Controllers;
use App\Models\Gallery;     
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query();
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
                'user_id'     => auth()->id(),
            ]);

            DB::commit();

            return redirect()->route('galleries.index')->with('success', 'Blog created successfully');
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

    public function create()
    {
        return view('backend.galleries.create');
    }

    public function update()
    {

    }

    public function destroy()
    {
        
    }
}
