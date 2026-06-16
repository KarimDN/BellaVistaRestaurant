@extends('layouts.app')

@section('title', 'Welcome')

@section('content')
<style>
    .hero {
        background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)),
                    url('https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=1600') center/cover;
        height: 90vh;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
    }
    .hero h1 {
        font-size: 4rem;
        letter-spacing: 4px;
        color: #c9a84c;
        margin-bottom: 1rem;
    }
    .hero p {
        font-size: 1.3rem;
        margin-bottom: 2.5rem;
        color: #ddd;
    }
    .btn {
        background: #c9a84c;
        color: #1a1a1a;
        padding: 1rem 2.5rem;
        text-decoration: none;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        letter-spacing: 2px;
        text-transform: uppercase;
        margin: 0.5rem;
        display: inline-block;
        transition: background 0.3s;
    }
    .btn:hover { background: #b8943d; }
    .btn-outline {
        background: transparent;
        border: 2px solid #c9a84c;
        color: #c9a84c;
    }
    .btn-outline:hover { background: #c9a84c; color: #1a1a1a; }

    #chat-icon {
    position: fixed;
    bottom: 25px;
    right: 25px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: #c9a84c;
    color: #1a1a1a;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 24px;
    text-decoration: none;
    box-shadow: 0 8px 20px rgba(0,0,0,0.3);
    z-index: 9999;
    transition: transform 0.2s ease, background 0.3s;
    }

    #chat-icon:hover {
        transform: scale(1.1);
        background: #b8943d;
    }
</style>

<div class="hero">
    <h1>BELLA VISTA</h1>
    <p>An unforgettable dining experience in the heart of the city</p>
    <div>
        <a href="{{ route('menu.index') }}" class="btn">View Menu</a>
        <a href="{{ route('reservations.create') }}" class="btn btn-outline">Reserve a Table</a>
    </div>
    <!-- Floating Chat Button -->
    <a href="{{ route('chat.index') }}" id="chat-icon">💬</a>
</div>
@endsection