<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use App\Models\Player;
use App\Models\Club;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ImportFplPlayers extends Command {
    protected $signature = 'fpl:import-latest {--cache= : path to write/read bootstrap-static.json}';
    protected $description = 'Import players and teams from fantasy.premierleague.com bootstrap-static';

    public function handle(): int {
        $cache = $this->option('cache');

        if ($cache && file_exists($cache)) {
            $this->info("Reading cached JSON: $cache");
            $json = json_decode(file_get_contents($cache), true);
        } else {
            $this->info('Fetching https://fantasy.premierleague.com/api/bootstrap-static/ ...');
            $resp = Http::timeout(20)->get('https://fantasy.premierleague.com/api/bootstrap-static/');
            if (!$resp->ok()) {
                $this->error('Failed HTTP: '.$resp->status());
                return self::FAILURE;
            }
            $json = $resp->json();
            if ($cache) {
                @file_put_contents($cache, json_encode($json, JSON_PRETTY_PRINT));
                $this->info("Cached to $cache");
            }
        }

        $elements = Arr::get($json,'elements',[]);
        $teams = collect(Arr::get($json,'teams',[]))->keyBy('id');

        $typeMap = collect(Arr::get($json,'element_types',[]))
            ->keyBy('id')
            ->map(fn($t) => $t['singular_name_short'] ?? $t['singular_name'] ?? '')
            ->toArray();

        $posMap = ['GKP'=>'GK','DEF'=>'DEF','MID'=>'MID','FWD'=>'FWD','GK'=>'GK'];

        // Truncate outside transaction
        Schema::disableForeignKeyConstraints();
        Club::truncate();
        Player::truncate();
        Schema::enableForeignKeyConstraints();

        // Import inside a transaction
        DB::transaction(function() use ($elements, $teams, $typeMap, $posMap) {
            foreach ($teams as $t) {
                Club::create([
                    'id' => $t['id'],
                    'name' => $t['name'],
                    'short_name' => $t['short_name'] ?? $t['short_name']
                ]);
            }

            $count = 0;
            foreach ($elements as $e) {
                $typeKey = $typeMap[$e['element_type']] ?? null;
                $pos = $posMap[$typeKey] ?? null;
                if (!$pos) continue;

                $clubModel = Club::find($e['team']);

                Player::create([
                    'first_name' => $e['first_name'] ?? null,
                    'second_name' => $e['second_name'] ?? null,
                    'name' => trim(($e['first_name'] ?? '').' '.($e['second_name'] ?? '')),
                    'position' => $pos,
                    'club_id' => $clubModel ? $clubModel->id : null,
                    'price' => isset($e['now_cost']) ? round($e['now_cost']/10,1) : 4.0,
                ]);

                $count++;
            }

            $this->info("Imported $count players.");
        });

        return self::SUCCESS;
    }
}
