<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;

class EquipmentController extends Controller
{
    /**
     * Display a listing of equipment.
     */
    public function index(Request $request)
    {
        $query = Equipment::query()->with('location');

        // Filter by type
        if ($request->filled('type')) {
            if ($request->type !== 'all') {
                $query->where('type', $request->type);
            }
        }

        // Search functionality
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('description', 'like', '%' . $request->search . '%')
                  ->orWhereHas('location', function ($q) {
                      $q->where('name', 'like', '%' . request()->search . '%');
                  });
        }

        // Sorting
        $sort = $request->get('sort', 'latest');
        if ($sort === 'latest') {
            $query->latest();
        } elseif ($sort === 'oldest') {
            $query->oldest();
        } elseif ($sort === 'name_asc') {
            $query->orderBy('name', 'asc');
        } elseif ($sort === 'name_desc') {
            $query->orderBy('name', 'desc');
        }

        $equipment = $query->paginate(12);
        $type = $request->get('type', 'all');

        return view('equipment.index', [
            'equipment' => $equipment,
            'type' => $type,
            'search' => $request->search,
            'sort' => $sort,
        ]);
    }

    /**
     * Display the specified equipment.
     */
    public function show(Equipment $equipment)
    {
        $equipment->load('location');
        return view('equipment.show', ['equipment' => $equipment]);
    }
}
