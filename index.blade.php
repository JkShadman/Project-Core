<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Premier League Players') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Available Players</h5>
                </div>
                <div class="card-body">
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
                                    <th>Goals</th>
                                    <th>Assists</th>
                                    <th>Minutes</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($players as $player)
                                    <tr>
                                        <td>
                                            @if($player->photo_url)
                                                <img src="{{ $player->photo_url }}" alt="{{ $player->name }}" 
                                                     style="width: 40px; height: 40px; object-fit: cover;" 
                                                     class="rounded-circle">
                                            @else
                                                <div class="bg-secondary rounded-circle d-flex align-items-center justify-content-center" 
                                                     style="width: 40px; height: 40px;">
                                                    <span class="text-white">{{ substr($player->name, 0, 1) }}</span>
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <strong>{{ $player->name }}</strong>
                                            <br>
                                            <small class="text-muted">Influence: {{ $player->influence }}</small>
                                        </td>
                                        <td>
                                            <span class="badge bg-info">{{ $player->position }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ $player->team }}</span>
                                        </td>
                                        <td>
                                            <span class="text-success fw-bold">£{{ number_format($player->price, 1) }}m</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $player->total_points }}</span>
                                        </td>
                                        <td>{{ $player->goals_scored }}</td>
                                        <td>{{ $player->assists }}</td>
                                        <td>{{ $player->minutes_played }}</td>
                                        <td>
                                            <a href="{{ route('players.show', $player) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    <div class="mt-3">
                        {{ $players->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
