<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonials = Testimonial::orderBy('created_at', 'asc')->get();

        return view('backend.testimonials.main', compact('testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
        ]);

        Testimonial::create([
            'name' => $validated['name'],
            'bio' => $validated['bio'],
            'review' => $validated['review'],
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial created successfully');
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
        $testimonial = Testimonial::findOrFail($id);

        return view('backend.testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'bio' => 'required|string|max:255',
            'review' => 'required|string|max:1000',
        ]);

        $testimonial = Testimonial::findOrFail($id);
        $testimonial->update([
            'name' => $validated['name'],
            'bio' => $validated['bio'],
            'review' => $validated['review'],
        ]);

        return redirect()->route('testimonials.index')->with('success', 'Testimonial updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        return redirect()->route('testimonials.index')->with('success', 'Testimonial deleted successfully');
    }
}
