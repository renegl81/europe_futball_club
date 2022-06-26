<?php

namespace Database\Seeders;

use App\Http\Services\ApiService;
use App\Models\Club;
use App\Models\Coach;
use App\Models\League;
use App\Models\Person;
use App\Models\Player;
use App\Models\Position;
use App\Models\Season;
use App\Models\Stadium;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ClubSeeder extends Seeder
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
        $leagues = League::all();
        foreach ($leagues as $league){
            $data = $this->apiService->findTeams($league->api_id);
            foreach ($data->teams as $team) {
                $name = substr($team->crest, strrpos($team->crest, '/') + 1);
                if(!Storage::get('public/images/teams/'.$name)){
                    $contents = file_get_contents($team->crest);
                    Storage::put('public/images/teams/'.$name, $contents);
                }

                $club = Club::firstOrCreate(
                    [
                        'name' => $team->name,
                        'shortName' => $team->shortName,
                        'code' => $team->tla,
                        'address' => $team->address,
                        'colors' => $team->clubColors,
                        'website' => $team->website,
                        'founded' => $team->founded,
                        'logo' => $name,
                        'league_id' => $league->id
                    ]);

                $club->save();

                $season = Season::where('api_id', $data->season->id)->first();
                $coach = null;
                if(null != $team->coach->id){
                    $coach = Coach::firstOrCreate(
                        [
                            "name" => $team->coach->firstName,
                            "lastName" => $team->coach->lastName,
                            "api_id" => $team->coach->id,
                            "dateOfBirth" => $team->coach->dateOfBirth,
                            "nationality" => $team->coach->nationality
                        ]);
                    $coach->save();
                }
                $stadium =null;
              /*  if($team->venue){
                    $stadium = Stadium::firstOrCreate([
                        'name' => $team->venue
                    ]);
                    $stadium->save();
                }*/
                $eq = Team::firstOrCreate(
                    [
                        'api_id' => $team->id,
                        'club_id' => $club->id,
                        'season_id' => $season->id,
                        'coach_id' => $coach ? $coach->id : null,
                        'stadium_id' => $stadium,
                    ]);

                $eq->save();

                foreach ($team->squad as $player) {
                    $person = Person::firstOrCreate([
                        "name" => $player->name,
                        "dateOfBirth" => $player->dateOfBirth,
                        "nationality" => $player->nationality
                    ]);
                    $person->save();
                    $position = Position::where('name',  $player->position)->first();
                    $p = Player::firstOrCreate([
                        "api_id" => $player->id,
                        "position_id" => $position ? $position->id : null,
                        "person_id" => $person->id,
                        "team_id" => $eq->id
                    ]);
                    $p->save();
                }
            }
        }

  }
}
