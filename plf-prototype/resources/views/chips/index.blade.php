@extends('layouts.app')
@section('content')
<h2>Chips ({{ $gw->name }})</h2>
<p>Available chips: Wildcard, Free Hit, Bench Boost, Triple Captain. Use carefully — each can be played once per season (in prototype tracked per team).</p>

<form method="post" action="{{ route('chips.play') }}">
  @csrf
  <label><input type="radio" name="type" value="wildcard"> Wildcard</label>
  <label><input type="radio" name="type" value="freehit"> Free Hit</label>
  <label><input type="radio" name="type" value="benchboost"> Bench Boost</label>
  <label><input type="radio" name="type" value="triplecaptain"> Triple Captain</label>
  <button type="submit">Play Chip for {{ $gw->name }}</button>
</form>
@endsection
