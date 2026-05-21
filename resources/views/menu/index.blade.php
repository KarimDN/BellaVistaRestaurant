@extends('layouts.app')

@section('title', 'Our Menu')

@section('content')
<style>
    .menu-hero {
        background: #1a1a1a;
        color: #c9a84c;
        text-align: center;
        padding: 4rem 2rem;
        letter-spacing: 3px;
    }
    .menu-hero p {
        color: #888;
        font-family: 'Arial', sans-serif;
        letter-spacing: 1px;
        margin-top: 0.5rem;
    }
    .menu-container {
        max-width: 1000px;
        margin: 3rem auto;
        padding: 0 2rem;
    }
    .category-section {
        margin-bottom: 3rem;
    }
    .category-title {
        font-size: 1.8rem;
        color: #1a1a1a;
        border-bottom: 2px solid #c9a84c;
        padding-bottom: 0.5rem;
        margin-bottom: 1.5rem;
        letter-spacing: 2px;
    }
    .menu-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    .menu-card {
        background: white;
        border: 1px solid #eee;
        padding: 1.5rem;
        transition: box-shadow 0.3s;
    }
    .menu-card:hover { box-shadow: 0 4px 15px rgba(0,0,0,0.1); }
    .menu-card h3 {
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
        color: #1a1a1a;
    }
    .menu-card p {
        color: #888;
        font-family: 'Arial', sans-serif;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    .menu-card .price {
        color: #c9a84c;
        font-size: 1.2rem;
        font-weight: bold;
        font-family: 'Arial', sans-serif;
    }
    .unavailable { opacity: 0.5; }
</style>

<div class="menu-hero">
    <h1>OUR MENU</h1>
    <p>Crafted with passion, served with love</p>
</div>

<div class="menu-container">
    @foreach($categories as $category)
        @if($category->menuItems->count() > 0)
        <div class="category-section">
            <h2 class="category-title">{{ $category->name }}</h2>
            <div class="menu-grid">
                @foreach($category->menuItems as $item)
                <div class="menu-card {{ !$item->is_available ? 'unavailable' : '' }}">
                    <h3>{{ $item->name }}</h3>
                    <p>{{ $item->description }}</p>
                    <span class="price">${{ number_format($item->price, 2) }}</span>
                    @if(!$item->is_available)
                        <span style="color:#999; font-size:0.8rem; margin-left:0.5rem;">(Unavailable)</span>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection