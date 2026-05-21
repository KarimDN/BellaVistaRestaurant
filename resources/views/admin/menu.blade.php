@extends('layouts.app')

@section('title', 'Manage Menu')

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
    }
    .admin-nav a:hover { background: #333; }
    .menu-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
    }
    .menu-table th {
        background: #1a1a1a;
        color: #c9a84c;
        padding: 1rem;
        text-align: left;
        font-family: 'Arial', sans-serif;
        font-size: 0.8rem;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
    .menu-table td {
        padding: 1rem;
        border-bottom: 1px solid #eee;
        font-family: 'Arial', sans-serif;
        font-size: 0.9rem;
    }
    .menu-table tr:hover { background: #faf9f7; }
    .btn-delete {
        background: #e74c3c;
        color: white;
        border: none;
        padding: 0.3rem 0.8rem;
        font-family: 'Arial', sans-serif;
        font-size: 0.8rem;
        cursor: pointer;
        font-weight: bold;
    }
    .btn-delete:hover { background: #c0392b; }
</style>

<div class="admin-container">
    <div class="admin-header">
        <h1>MANAGE MENU</h1>
        <div class="admin-nav">
            <a href="{{ route('admin.dashboard') }}">← Dashboard</a>
        </div>
    </div>

    <table class="menu-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Available</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->category->name }}</td>
                <td>${{ number_format($item->price, 2) }}</td>
                <td>{{ $item->is_available ? '✅' : '❌' }}</td>
                <td>
                    <form action="{{ route('admin.menu.delete', $item) }}" method="POST"
                          onsubmit="return confirm('Delete {{ $item->name }}?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-delete">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align:center; color:#888; padding:2rem;">
                    No menu items found.
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection