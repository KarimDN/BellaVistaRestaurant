<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bella Vista | @yield('title', 'Fine Dining')</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }

        body {
            font-family: 'Georgia', serif;
            background: #faf9f7;
            color: #2c2c2c;
        }

        /* NAV */
        nav {
            background: #1a1a1a;
            padding: 1.2rem 3rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        nav .logo {
            color: #c9a84c;
            font-size: 1.6rem;
            letter-spacing: 2px;
            text-decoration: none;
        }
        nav ul {
            list-style: none;
            display: flex;
            gap: 2rem;
        }
        nav ul a {
            color: #fff;
            text-decoration: none;
            font-family: 'Arial', sans-serif;
            font-size: 0.9rem;
            letter-spacing: 1px;
            text-transform: uppercase;
            transition: color 0.3s;
        }
        nav ul a:hover { color: #c9a84c; }

        /* MAIN */
        main { min-height: calc(100vh - 140px); }

        /* FOOTER */
        footer {
            background: #1a1a1a;
            color: #888;
            text-align: center;
            padding: 1.5rem;
            font-family: 'Arial', sans-serif;
            font-size: 0.85rem;
        }

        /* FLASH MESSAGE */
        .flash-success {
            background: #d4edda;
            color: #155724;
            padding: 1rem 2rem;
            text-align: center;
            font-family: 'Arial', sans-serif;
        }
    </style>
    @stack('styles')
</head>
<body>

<nav>
    <a href="{{ route('menu.index') }}" class="logo">BELLA VISTA</a>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="{{ route('menu.index') }}">Menu</a></li>
        <li><a href="{{ route('reservations.create') }}">Reservations</a></li>
    </ul>
</nav>

@if(session('success'))
    <div class="flash-success">{{ session('success') }}</div>
@endif

<main>
    @yield('content')
</main>

<footer>
    <p>&copy; {{ date('Y') }} Bella Vista. All rights reserved.</p>
</footer>

</body>
</html>