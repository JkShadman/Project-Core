@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Global Leaderboard</h2>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Team Name</th>
                                <th>Manager</th>
                                <th>Total Points</th>
                                <th>Team Value</th>
                                <th>Budget</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($users as $index => $user)
                                <tr>
                                    <td>
                                        <strong>#{{ ($users->currentPage() - 1) * $users->perPage() + $index + 1 }}</strong>
                                    </td>
                                    <td>
                                        <strong>{{ $user->team_name }}</strong>
                                        @if(auth()->id() === $user->id)
                                            <span class="badge bg-primary">You</span>
                                        @endif
                                    </td>
                                    <td>{{ $user->name }}</td>
                                    <td>
                                        <span class="points-badge">{{ $user->total_points }}</span>
                                    </td>
                                    <td>£{{ number_format($user->team_value, 1) }}</td>
                                    <td>£{{ number_format($user->budget, 1) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-center mt-4">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
