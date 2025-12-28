<?php

namespace App\Http\Controllers;

use App\Models\Property;
use Illuminate\Http\Request;

class AdminPropertyController extends Controller
{
    // List all properties with pagination
    public function index()
    {
        $properties = Property::with('user', 'media')->latest()->paginate(10);

        $totalProperties = Property::count();
        $pendingProperties = Property::where('status', 'pending')->count();
        $approvedProperties = Property::where('status', 'approved')->count();
        $soldProperties = Property::where('status', 'sold')->count();

        return view('admin.properties', compact(
            'properties',
            'totalProperties',
            'pendingProperties',
            'approvedProperties',
            'soldProperties'
        ));
    }

    // Return single property as JSON for modal
    public function show($id)
    {
        $property = Property::with(['user', 'media'])->findOrFail($id);

        return response()->json([
            'id' => $property->id,
            'title' => $property->title,
            'description' => $property->description,
            'location' => $property->location,
            'price' => $property->price,
            'type' => $property->type,
            'status' => $property->status,
            'images' => $property->media ? json_decode($property->media->file_path) : [],
            'agent' => [
                'name' => $property->user->name,
                'image' => $property->user->profile_image ?? '/images/default-agent.png',
            ],
        ]);
    }

    // Approve a property
    public function approve($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'approved';
        $property->save();

        return response()->json(['message' => 'Property approved successfully']);
    }

    // Reject a property
    public function reject($id)
    {
        $property = Property::findOrFail($id);
        $property->status = 'rejected';
        $property->save();

        return response()->json(['message' => 'Property rejected successfully']);
    }

    // Delete a property
    public function destroy($id)
    {
        $property = Property::findOrFail($id);
        $property->delete();

        return response()->json(['message' => 'Property deleted successfully']);
    }

    // Bulk action handler
    public function bulkAction(Request $request)
    {
        $action = $request->action; // approve, reject, delete
        $ids = $request->ids; // array of property IDs

        $properties = Property::whereIn('id', $ids);

        if ($action === 'approve') {
            $properties->update(['status' => 'approved']);
        } elseif ($action === 'reject') {
            $properties->update(['status' => 'rejected']);
        } elseif ($action === 'delete') {
            $properties->delete();
        }

        return response()->json(['message' => 'Bulk action completed']);
    }
}
