@extends('layouts.app')
@section('content')
<h2>Transfers ({{ $gw->name }})</h2>
<p>Free transfers: 1. Extra transfers cost 4 points each.</p>

<h3>Your squad</h3>
<div style="display:grid;grid-template-columns:repeat(3,1fr);gap:12px">
  @foreach($current as $pl)
  <article>
    <h4>{{ $pl->name }} <small>{{ $pl->position }}</small></h4>
    <p>{{ $pl->club->name ?? '' }} — £{{ $pl->price }}</p>

    <form method="post" action="{{ route('transfers.swap') }}">
      @csrf
      <input type="hidden" name="out_player_id" value="{{ $pl->id }}">
      <label>Swap with:
        <select name="in_player_id">
          @foreach($market->where('position',$pl->position) as $m)
            @if(!$current->pluck('id')->contains($m->id))
              <option value="{{ $m->id }}">{{ $m->name }} — £{{ $m->price }}</option>
            @endif
          @endforeach
        </select>
      </label>
      <button type="submit">Swap</button>
    </form>
  </article>
  @endforeach
</div>
@endsection
