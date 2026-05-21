@extends('layouts.app')

@section('title', 'Reserve a Table')

@section('content')
<style>
    .res-hero {
        background: #1a1a1a;
        color: #c9a84c;
        text-align: center;
        padding: 4rem 2rem;
        letter-spacing: 3px;
    }
    .res-hero p {
        color: #888;
        font-family: 'Arial', sans-serif;
        letter-spacing: 1px;
        margin-top: 0.5rem;
    }
    .res-container {
        max-width: 600px;
        margin: 3rem auto;
        padding: 0 2rem;
    }
    .form-group {
        margin-bottom: 1.5rem;
    }
    .form-group label {
        display: block;
        font-family: 'Arial', sans-serif;
        font-size: 0.85rem;
        letter-spacing: 1px;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
        color: #555;
    }
    .form-group input,
    .form-group select,
    .form-group textarea {
        width: 100%;
        padding: 0.8rem 1rem;
        border: 1px solid #ddd;
        font-family: 'Georgia', serif;
        font-size: 1rem;
        background: #fff;
        transition: border 0.3s;
    }
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #c9a84c;
    }
    .form-row {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
    }
    .error-msg {
        color: #e74c3c;
        font-family: 'Arial', sans-serif;
        font-size: 0.8rem;
        margin-top: 0.3rem;
    }
    .btn-submit {
        width: 100%;
        background: #c9a84c;
        color: #1a1a1a;
        padding: 1rem;
        border: none;
        font-family: 'Arial', sans-serif;
        font-weight: bold;
        font-size: 1rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        cursor: pointer;
        transition: background 0.3s;
    }
    .btn-submit:hover { background: #b8943d; }
</style>

<div class="res-hero">
    <h1>RESERVE A TABLE</h1>
    <p>We look forward to welcoming you</p>
</div>

<div class="res-container">
    <form action="{{ route('reservations.store') }}" method="POST">
        @csrf

        <div class="form-row">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="customer_name"
                    value="{{ old('customer_name') }}"
                    placeholder="John Doe">
                @error('customer_name')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="text" name="customer_phone"
                    value="{{ old('customer_phone') }}"
                    placeholder="+1 234 567 8900">
                @error('customer_phone')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email" name="customer_email"
                value="{{ old('customer_email') }}"
                placeholder="john@example.com">
            @error('customer_email')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-row">
            <div class="form-group">
                <label>Date</label>
                <input type="date" name="reservation_date"
                    value="{{ old('reservation_date') }}">
                @error('reservation_date')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label>Time</label>
                <input type="time" name="reservation_time"
                    value="{{ old('reservation_time') }}">
                @error('reservation_time')
                    <p class="error-msg">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <label>Number of Guests</label>
            <select name="guests">
                @for($i = 1; $i <= 20; $i++)
                    <option value="{{ $i }}"
                        {{ old('guests') == $i ? 'selected' : '' }}>
                        {{ $i }} {{ $i == 1 ? 'Guest' : 'Guests' }}
                    </option>
                @endfor
            </select>
            @error('guests')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <div class="form-group">
            <label>Special Requests <span style="color:#aaa">(optional)</span></label>
            <textarea name="special_requests" rows="3"
                placeholder="Allergies, occasions, seating preferences...">{{ old('special_requests') }}</textarea>
            @error('special_requests')
                <p class="error-msg">{{ $message }}</p>
            @enderror
        </div>

        <button type="submit" class="btn-submit">Confirm Reservation</button>
    </form>
</div>
@endsection