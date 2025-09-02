@extends('layouts.app')
@section('content')
<h2>Pick Squad</h2>
<p>Rules: 15 players: GK×2, DEF×5, MID×5, FWD×3. Max 3 players per club. Budget ≤ £100.0</p>

<form method="post" action="{{ route('team.save') }}">
  @csrf
  <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:8px">
    @foreach ($players as $pl)
      <label style="border:1px solid #ddd;padding:8px;border-radius:6px;">
        <input type="checkbox" name="player_ids[]" value="{{ $pl->id }}" @checked(in_array($pl->id,$existing ?? []))>
        <strong>{{ $pl->name }}</strong><br>
        <small>{{ $pl->club->name ?? '' }}</small><br>
        <span>{{ $pl->position }} — £{{ number_format($pl->price,1) }}m</span>
        @if($pl->injury_level !== 'none')<div class="injury {{ $pl->injury_level }}">{{ $pl->injury_level }}</div>@endif
      </label>
    @endforeach
  </div>
  <button type="submit">Save Squad</button>
</form>
@endsection
