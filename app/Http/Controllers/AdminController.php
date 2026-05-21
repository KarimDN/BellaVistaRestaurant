<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\MenuItem;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard - shows reservation summary
    public function dashboard()
    {
        $reservations = Reservation::orderBy('reservation_date', 'asc')
                                   ->orderBy('reservation_time', 'asc')
                                   ->get();

        $pending   = $reservations->where('status', 'pending')->count();
        $confirmed = $reservations->where('status', 'confirmed')->count();
        $cancelled = $reservations->where('status', 'cancelled')->count();

        return view('admin.dashboard', compact(
            'reservations',
            'pending',
            'confirmed',
            'cancelled'
        ));
    }

    // Update reservation status
    public function updateReservation(\Illuminate\Http\Request $request, Reservation $reservation)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled'
        ]);

        $reservation->update(['status' => $request->status]);

        return back()->with('success', 'Reservation updated successfully.');
    }

    // Menu management
    public function menuIndex()
    {
        $items = MenuItem::with('category')->orderBy('category_id')->get();
        return view('admin.menu', compact('items'));
    }

    // Delete menu item
    public function deleteMenuItem(MenuItem $menuItem)
    {
        $menuItem->delete();
        return back()->with('success', 'Menu item deleted.');
    }
}