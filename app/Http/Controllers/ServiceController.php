<?php

namespace App\Http\Controllers;

use App\Models\Service;
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

    public function store()
    {

    }

    public function create()
    {
        return view('backend.services.create');
    }

    public function update()
    {

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

                return redirect()->route('services.index')->with('success', 'Layanan deleted successfully');
            } catch (\Exception $e) {
                DB::rollBack();

                Log::error('Error deleting Layanan: ' . $e->getMessage(), [
                    'trace' => $e->getTrace(),
                ]);

                return redirect()->back()
                    ->with('error', 'An error occurred while deleting the Layanan. Please try again later.');
        }
    }

}
