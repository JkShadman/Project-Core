@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header text-center">
                <h1 class="display-4 text-primary">
                    <i class="fas fa-futbol"></i> Fantasy Premier League Clone
                </h1>
            </div>
            <div class="card-body text-center">
                <p class="lead">Build your dream team and compete against other managers!</p>
                
                <div class="row mt-5">
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-users fa-3x text-primary mb-3"></i>
                                <h5>Player Management</h5>
                                <p>Browse and select from hundreds of Premier League players</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-trophy fa-3x text-warning mb-3"></i>
                                <h5>Team Building</h5>
                                <p>Create your perfect squad within budget constraints</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <i class="fas fa-chart-line fa-3x text-success mb-3"></i>
                                <h5>Live Scoring</h5>
                                <p>Track points based on real Premier League performances</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h4>Get Started</h4>
                    <div class="d-flex justify-content-center gap-3 mt-3">
                        @auth
                            <a href="{{ route('players.index') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-search"></i> Browse Players
                            </a>
                            <a href="{{ route('team.index') }}" class="btn btn-success btn-lg">
                                <i class="fas fa-users"></i> My Team
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">
                                <i class="fas fa-user-plus"></i> Register
                            </a>
                            <a href="{{ route('login') }}" class="btn btn-outline-primary btn-lg">
                                <i class="fas fa-sign-in-alt"></i> Login
                            </a>
                        @endauth
                    </div>
                </div>

                <div class="mt-5">
                    <h5>Current Standings</h5>
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    @php
                                        $topUsers = \App\Models\User::orderBy('total_points', 'desc')->take(3)->get();
                                    @endphp
                                    @if($topUsers->count() > 0)
                                        <ul class="list-group">
                                            @foreach($topUsers as $index => $user)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <span>
                                                        <strong>#{{ $index + 1 }}</strong>
                                                        {{ $user->team_name }}
                                                    </span>
                                                    <span class="points-badge">{{ $user->total_points }} pts</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @else
                                        <p class="text-muted">No teams yet. Be the first to register!</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
