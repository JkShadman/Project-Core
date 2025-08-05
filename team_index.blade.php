<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Fantasy Team') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5 class="mb-0">Current Team</h5>
                        </div>
                        <div class="card-body">
                            @if($team->isEmpty())
                                <div class="text-center py-5">
                                    <h5 class="text-muted">No players selected yet</h5>
                                    <a href="{{ route('team.create') }}" class="btn btn-primary mt-3">
                                        Create Your Team
                                    </a>
                                </div>
                            @else
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Photo</th>
                                                <th>Name</th>
                                                <th>Position</th>
                                                <th>Team</th>
                                                <th>Price</th>
                                                <th>Points</th>
                                                <th>Role</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($user->players as $player)
                                                <tr>
                                                    <td>
                                                        @if($player->photo_url)
                                                            <img src="{{ $player->photo_url }}" alt="{{ $player->name }}" 
                                                                 style="width: 35px; height: 35px; object-fit: cover;" 
                                                                 class="rounded-circle">
                                                        @else
                                                            <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                                                 style="width: 35px; height: 35px;">
                                                                <span class="text-white">{{ substr($player->name, 0, 1) }}</span>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td><strong>{{ $player->name }}</strong></td>
                                                    <td>{{ $player->position }}</td>
                                                    <td>{{ $player->team }}</td>
                                                    <td>£{{ number_format($player->price, 1) }}m</td>
                                                    <td>{{ $player->total_points }}</td>
                                                    <td>
                                                        @if($user->players()->where('player_id', $player->id)->first()->pivot->is_captain)
                                                            <span class="badge bg-warning">Captain</span>
                                                        @elseif($user->players()->where('player_id', $player->id)->first()->pivot->is_vice_captain)
                                                            <span class="badge bg-secondary">Vice Captain</span>
                                                        @else
                                                            <span class="badge bg-light text-dark">Player</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header bg-info text-white">
                            <h5 class="mb-0">Team Summary</h5>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <strong>Total Points:</strong>
                                <span class="badge bg-primary">{{ $user->total_points }}</span>
                            </div>
                            <div class="mb-3">
                                <strong>Gameweek Points:</strong>
                                <span class="badge bg-success">{{ $user->gameweek_points }}</span>
                            </div>
                            <div class="mb-3">
                                <strong>Team Value:</strong>
                                <span class="text-success">£{{ number_format($teamValue, 1) }}m</span>
                            </div>
                            <div class="mb-3">
                                <strong>Remaining Budget:</strong>
                                <span class="text-primary">£{{ number_format($remainingBudget, 1) }}m</span>
                            </div>
                            <div class="mb-3">
                                <strong>Transfers Left:</strong>
                                <span class="badge bg-warning">{{ $user->transfers_remaining }}</span>
                            </div>
                            
                            <div class="mt-4">
                                <a href="{{ route('team.create') }}" class="btn btn-primary w-100 mb-2">
                                    Edit Team
                                </a>
                                <a href="{{ route('team.transfers') }}" class="btn btn-outline-primary w-100">
                                    Make Transfers
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
