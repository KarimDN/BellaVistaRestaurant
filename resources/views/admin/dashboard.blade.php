@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    .admin-container {
        max-width: 1100px;
        margin: 3rem auto;
        padding: 0 2rem;
    }
    .admin-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    .admin-header h1 {
        font-size: 1.8rem;
        letter-spacing: 2px;
        color: #1a1a1a;
    }
    .admin-nav a {
        background: #1a1a1a;
        color: #c9a84c;
        padding: 0.6rem 1.2rem;
        text-decoration: none;
        font-family: 'Arial', sans-serif;
        font-size: 0.85rem;
        letter-spacing: 1px;
        margin-left: 0.5rem;
        transition: background 0.3s;
    }
    .admin-nav a:hover { background: #333; }

    /* STATS */
    .stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }
    .stat-card {
        background: white;
        border: 1px solid #eee;
        padding: 1.5rem;
        text-align: center;
    }
    .stat-card .number {
        font-size: 2.5rem;
        font-weight: bold;
        color: #c9a84c;
    }
    .stat-card .label {
        font-family: 'Arial', sans-serif;
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        color: #888;
        margin-top: 0.3rem;
    }

    /* TABLE */
    .reservations-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }
    .reservations-table th {
        background: #1a1a1a;
        color: #c9a84c;
        padding: 1rem;
        text-align: left;
        font-family: 'Arial', sans-serif;
        font-size: 0.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .reservations-table td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        font-family: 'Arial', sans-serif;
        font-size: 0.9rem;
    }
    .reservations-table tr:hover { background: #faf9f7; }

    /* STATUS BADGES */
    .badge {
        padding: 0.3rem 0.8rem;
        font-size: 0.75rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        font-weight: bold;
    }
    .badge-pending   { background: #fff3cd; color: #856404; }
    .badge-confirmed { background: #d4edda; color: #155724; }
    .badge-cancelled { background: #f8d7da; color: #721c24; }

    /* STATUS FORM */
    .status-form select {
        padding: 0.3rem 0.5rem;
        border: 1px solid #ddd;
        font-family: 'Arial', sans-serif;
        font-size: 0.85rem;
        margin-right: 0.3rem;
    }
    .status-form button {
        background: #c9a84c;
        color: #1a1a1a;
        border: none;
        padding: 0.3rem 0.8rem;
        font-family: 'Arial', sans-serif;
        font-size: 0.8rem;
        cursor: pointer;
        font-weight: bold;
    }
    .status-form button:hover { background: #b8943d; }
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>ADMIN DASHBOARD</h1>
        <div class="admin-nav">
            <a href="{{ route('admin.menu') }}">Manage Menu</a>
            <a href="{{ route('home') }}"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
               Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
                @csrf
            </form>
        </div>
    </div>

    {{-- Stats --}}
    <div class="stats">
        <div class="stat-card">
            <div class="number">{{ $pending }}</div>
            <div class="label">Pending</div>
        </div>
        <div class="stat-card">
            <div class="number">{{ $confirmed }}</div>
            <div class="label">Confirmed</div>
        </div>
        <div class="stat-card">
            <div class="number">{{ $cancelled }}</div>
            <div class="label">Cancelled</div>
        </div>
    </div>

    {{-- Reservations Table --}}
    <table class="reservations-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Date</th>
                <th>Time</th>
                <th>Guests</th>
                <th>Status</th>
                <th>Update</th>
            </tr>
        </thead>
        <tbody>
            @forelse($reservations as $reservation)
            <tr>
                <td>{{ $reservation->customer_name }}</td>
                <td>{{ $reservation->customer_email }}</td>
                <td>{{ $reservation->customer_phone }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_date)->format('M d, Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($reservation->reservation_time)->format('h:i A') }}</td>
                <td>{{ $reservation->guests }}</td>
                <td>
                    <span class="badge badge-{{ $reservation->status }}">
                        {{ $reservation->status }}
                    </span>
                </td>
                <td>
                    <form class="status-form"
                          action="{{ route('admin.reservations.update', $reservation) }}"
                          method="POST">
                        @csrf
                        @method('POST')
                        <select name="status">
                            <option value="pending"   {{ $reservation->status == 'pending'   ? 'selected' : '' }}>Pending</option>
                            <option value="confirmed" {{ $reservation->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                            <option value="cancelled" {{ $reservation->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                        <button type="submit">Save</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align:center; color:#888; padding:2rem;">
                    No reservations yet.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection