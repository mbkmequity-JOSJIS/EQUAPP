<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Equipment;

class HomeController extends Controller
{
    /**
     * Display the home page
     */
    public function index()
    {
        // Get all locations with their equipment
        $locations = Location::with('equipment')->get();

        // Count total normal and broken devices
        $totalNormal = Equipment::where('status', 'normal')->count();
        $totalBroken = Equipment::whereIn('status', ['warning', 'broken'])->count();

        // Count total active devices and registered locations
        $totalActiveDevices = Equipment::where('status', 'normal')->count();
        $totalLocations = Location::count();

        return view('home', [
            'locations' => $locations,
            'totalNormal' => $totalNormal,
            'totalBroken' => $totalBroken,
            'totalActiveDevices' => $totalActiveDevices,
            'totalLocations' => $totalLocations,
        ]);
    }
}
