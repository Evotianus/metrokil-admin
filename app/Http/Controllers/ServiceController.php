<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Dotenv\Util\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ServiceController extends Controller
{
    public function index(Request $request)
    {
        $query = Service::query();
        $services = $query->orderBy('created_at', 'asc')->get();
        
        return view('backend.services.main', compact('services'));
        
    }

    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $validated = $request->validate([
                'name'       => 'required|string|max:255',
                'price' => 'required|string',
                'benefits'    => 'required|string',
                'description'       => 'required|string',
            ]);

            Service ::create([
                'name'       => $validated['name'],
                'price'    => $validated['price'],
                'benefits' => $validated['benefits'],
                'description'  => $validated['description'],
            ]);

            DB::commit();
            return redirect()->route('services.index')->with('success', 'Service created successfully');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error creating service: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while creating the Service. Please try again later.')
                ->withInput();
        }
    }

    public function create()
    {
        return view('backend.services.create');
    }

    public function update(Request $request, string $id)
    {
        DB::beginTransaction();

        try {
            // Find the existing blog post
            $service = Service::findOrFail($id);

            // Validate input
            $validated = $request->validate([
                'name'       => 'string|max:255',
                'price' => 'required|string',
                'benefits'    => 'required|string',
                'description'       => 'required|string', // Image is optional during update
            ]);

            // Update the blog post
            $service->update([
                'name'       => $validated['name'],
                'price'    => $validated['price'],
                'benefits' => $validated['benefits'],
                'description' => $validated['description'],
            ]);

            DB::commit();

            return redirect()->route('services.index')->with('success', 'Service updated successfully');
        } catch (\Exception $e) {
            DB::rollBack();

                Log::error('Error updating Service: ' . $e->getMessage(), [
                'trace' => $e->getTrace(),
            ]);

            return redirect()->back()
                ->with('error', 'An error occurred while updating the Service. Please try again later.')
                ->withInput();  
        }
    }

    public function edit(string $id)
    {
        $service = Service::findOrFail($id);

        return view('backend.services.edit', compact('service'));
    }

    public function destroy(string $id)
    {
        DB::beginTransaction();

        try
         {
                $service = Service::findOrFail($id);

                $service->delete();

                DB::commit();

                return redirect()->route('services.index')->with('success', 'Service deleted successfully');
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error('Error deleting Layanan: ' . $e->getMessage(), [
                    'trace' => $e->getTrace(),
                ]);

                return redirect()->back()
                    ->with('error', 'An error occurred while deleting the Service. Please try again later.');
        }
    }

}
