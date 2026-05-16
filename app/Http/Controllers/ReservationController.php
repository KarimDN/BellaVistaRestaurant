<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    // Shows the reservation form
    public function create()
    {
        return view('reservations.create');
    }

    // Handles form submission
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name'    => 'required|string|max:255',
            'customer_email'   => 'required|email',
            'customer_phone'   => 'required|string|max:20',
            'reservation_date' => 'required|date|after:today',
            'reservation_time' => 'required',
            'guests'           => 'required|integer|min:1|max:20',
            'special_requests' => 'nullable|string|max:500',
        ]);

        Reservation::create($validated);

        return redirect()->route('reservations.create')
                         ->with('success', 'Reservation made! We will confirm shortly.');
    }
}