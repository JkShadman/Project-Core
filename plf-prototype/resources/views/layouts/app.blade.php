<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Premier League Fantasy — Prototype</title>
  <meta name="viewport" content="width=device-width,initial-scale=1">
  @vite(['resources/js/app.jsx'])
  <link rel="stylesheet" href="https://unpkg.com/@picocss/pico@2.0.1/css/pico.min.css">
  <style>
    body{max-width:1100px;margin:2rem auto;}
    nav a{margin-right:1rem}
    .injury.yellow{background:#fff8cc;padding:4px;border-radius:4px}
    .injury.orange{background:#ffe4b5;padding:4px;border-radius:4px}
    .injury.red{background:#ffd6d6;padding:4px;border-radius:4px}
  </style>
</head>
<body>
  <header>
    <h1>Premier League Fantasy (Prototype)</h1>
    <nav>
      <a href="{{ route('players.index') }}">Players</a>
      <a href="{{ route('team.show') }}">My Team</a>
      <a href="{{ route('team.select') }}">Pick Team</a>
      <a href="{{ route('transfers.index') }}">Transfers</a>
      <a href="{{ route('chips.index') }}">Chips</a>
      <a href="{{ route('admin.dashboard') }}">Admin</a>
    </nav>
  </header>

  @if ($errors->any())
    <article>
      <strong>Errors</strong>
      <ul>@foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach</ul>
    </article>
  @endif
  @if(session('ok'))
    <article style="border-left:4px solid #3a5;padding-left:8px">{{ session('ok') }}</article>
  @endif

  <main>
    @yield('content')
  </main>
</body>
</html>
