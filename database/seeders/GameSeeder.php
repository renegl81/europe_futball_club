<?php

namespace Database\Seeders;

use App\Http\Services\ApiService;
use App\Models\Game;
use App\Models\League;
use App\Models\Season;
use App\Models\Team;
use Illuminate\Database\Seeder;

class GameSeeder extends Seeder
{
    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = $this->apiService->findMatchesByCompetition('PD', 2021);
        foreach ($data->matches as $game){
            $home = Team::where('api_id', $game->homeTeam->id)->first();
            $away = Team::where('api_id', $game->awayTeam->id)->first();
            if($away && $home){
                $match = Game::firstOrCreate([
                    "home_id" => $home->id,
                    "away_id" => $away->id,
                    "season_id" => $home->season->id,
                    "stage" => $game->stage,
                    "group" => $game->group,
                    "status" => $game->status,
                    "day" => $game->utcDate,
                    "matchDay" => $game->matchday,
                    "homeScore" => $game->score->fullTime->home,
                    "awayScore" => $game->score->fullTime->away,
                    "homeHalfScore" => $game->score->halfTime->home ?? 0,
                    "awayHalfScore" => $game->score->halfTime->away ?? 0,
                ]);

                $match->save();
            }

        }

    }
}
