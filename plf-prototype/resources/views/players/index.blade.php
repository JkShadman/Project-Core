@extends('layouts.app')

@section('content')
<h2>Players</h2>
<form method="get" style="display:flex;gap:8px;align-items:center">
  <input name="q" placeholder="Search player or club" value="{{ request('q') }}">
  <select name="position">
    <option value="">All positions</option>
    @foreach(['GK','DEF','MID','FWD'] as $p)
      <option value="{{ $p }}" @selected(request('position')===$p)>{{ $p }}</option>
    @endforeach
  </select>
  <button type="submit">Filter</button>
</form>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:12px">
  @foreach($players as $pl)
  <article>
    <h3>{{ $pl->name }} <small>({{ $pl->position }})</small></h3>
    <p><strong>{{ $pl->club->name ?? '—' }}</strong></p>
    <p>Price: £{{ number_format($pl->price,1) }}m</p>
    @if($pl->injury_level !== 'none')
      <div class="injury {{ $pl->injury_level }}">{{ strtoupper($pl->injury_level) }} — check updates</div>
    @endif
  </article>
  @endforeach
</div>

{{ $players->links() }}
@endsection
