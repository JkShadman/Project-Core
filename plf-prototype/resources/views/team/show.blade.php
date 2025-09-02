@extends('layouts.app')
@section('content')
<h2>My Team ({{ $gw->name }})</h2>

<p><a href="{{ route('team.select') }}">Edit Squad</a></p>

<form method="post" action="{{ route('team.captain') }}">
  @csrf
  <label>Captain:
    <select name="captain">
      @foreach($players as $p)
        <option value="{{ $p->id }}" @selected($p->id==($team->captain_id ?? null))>{{ $p->name }}</option>
      @endforeach
    </select>
  </label>
  <label>Vice Captain:
    <select name="vice_captain">
      @foreach($players as $p)
        <option value="{{ $p->id }}" @selected($p->id==($team->vice_captain_id ?? null))>{{ $p->name }}</option>
      @endforeach
    </select>
  </label>
  <button type="submit">Set Captains</button>
</form>

<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px;margin-top:12px">
  @foreach($players as $p)
  <article>
    <h4>{{ $p->name }} <small>{{ $p->position }}</small></h4>
    <p>{{ $p->club->name ?? '' }} — £{{ number_format($p->price,1) }}m</p>
    @if($p->injury_level!=='none')<div class="injury {{ $p->injury_level }}">{{ $p->injury_level }}</div>@endif
  </article>
  @endforeach
</div>
@endsection
