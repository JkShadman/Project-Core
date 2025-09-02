@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h2>Gameweek Fixtures</h2>
            </div>
            <div class="card-body">
                @foreach($gameweeks as $gameweek)
                    <div class="card mb-4">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="mb-0">
                                Gameweek {{ $gameweek->week_number }}
                                @if($gameweek->is_current)
                                    <span class="badge bg-success">Current</span>
                                @endif
                                @if($gameweek->is_finished)
                                    <span class="badge bg-secondary">Finished</span>
                                @endif
                            </h5>
                            <div>
                                <span class="text-muted">
                                    Deadline: {{ $gameweek->deadline->format('M j, Y H:i') }}
                                </span>
                                @if(!$gameweek->is_finished && !$gameweek->is_deadline_passed)
                                    <span class="badge bg-warning">
                                        {{ $gameweek->time_until_deadline->format('%d days %h hours') }} left
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            @if($gameweek->is_deadline_passed && !$gameweek->is_finished)
                                <div class="alert alert-info">
                                    <i class="fas fa-lock"></i> Gameweek {{ $gameweek->week_number }} has started. Transfers are locked.
                                </div>
                            @endif

                            @if($gameweek->is_finished)
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle"></i> Gameweek {{ $gameweek->week_number }} is complete.
                                </div>
                            @endif

                            <!-- This would typically show actual fixtures -->
                            <div class="text-center text-muted py-4">
                                <i class="fas fa-calendar-alt fa-3x mb-3"></i>
                                <p>Fixture data will be displayed here once available.</p>
                                <p>Check back closer to the deadline for match information.</p>
                            </div>

                            @auth
                                @if(!$gameweek->is_deadline_passed)
                                    <div class="d-flex gap-2 mt-3">
                                        <a href="{{ route('team.index') }}" class="btn btn-primary">
                                            <i class="fas fa-edit"></i> Make Transfers
                                        </a>
                                        <a href="{{ route('team.index') }}" class="btn btn-outline-primary">
                                            <i class="fas fa-crown"></i> Set Captain
                                        </a>
                                    </div>
                                @elseif($gameweek->is_finished)
                                    <a href="{{ route('leaderboard') }}" class="btn btn-success">
                                        <i class="fas fa-trophy"></i> View Standings
                                    </a>
                                @endif
                            @endauth
                        </div>
                    </div>
                @endforeach

                @if($gameweeks->isEmpty())
                    <div class="text-center py-5">
                        <i class="fas fa-calendar-times fa-3x text-muted mb-3"></i>
                        <h4>No gameweeks scheduled yet</h4>
                        <p class="text-muted">Check back later for the upcoming fixtures.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
