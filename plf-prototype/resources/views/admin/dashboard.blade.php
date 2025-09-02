@extends('layouts.app')
@section('content')
<h2>Admin Dashboard</h2>
<p>Create/Update player stats per GW to compute points.</p>
<form method="post" action="{{ route('admin.update_stats') }}">
  @csrf
  <label>Gameweek:
    <select name="gameweek_id">
      @foreach($gws as $gw) <option value="{{ $gw->id }}">{{ $gw->name }}</option> @endforeach
    </select>
  </label>
  <p>Paste JSON stats (player_id => fields) in the textarea below (prototype)</p>
  <textarea name="stats_json" style="width:100%;height:200px" placeholder='{"12":{"goals":1,"assists":0,...}}'></textarea>
  <button type="submit">Update</button>
</form>
@endsection
