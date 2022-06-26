<?php

namespace Database\Seeders;

use App\Http\Services\ApiService;
use App\Models\League;
use App\Models\Season;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class LeagueSeeder extends Seeder
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
       $data = $this->apiService->getCompetitions();

       foreach ($data as $competition) {
           $name = substr($competition->emblem, strrpos($competition->emblem, '/') + 1);
           if(!Storage::get('public/images/leagues/'.$name)){
               $contents = file_get_contents($competition->emblem);
               Storage::put('public/images/leagues/'.$name, $contents);
           }
           $league = League::firstOrCreate(
               [
                   'api_id' => $competition->id,
               ],
               [
               'api_id' => $competition->id,
               'name' => $competition->name,
               'code' => $competition->code,
               'logo' => $name,
               'country' => $competition->area->name
           ]);

           $league->save();
           $seasons = $this->apiService->getCompetitions($competition->id)->seasons;
           foreach ($seasons as $season){
               $startDate = explode('-', $season->startDate)[0];
               $temp = Season::firstOrCreate(
                   [
                       'api_id' => $season->id,
                       'startDate' => $season->startDate,
                       'endDate' => $season->endDate,
                       'currentMatchday' => $season->currentMatchday ?? null,
                       'year' => $startDate,
                       'league_id' => $league->id
                   ],
               );

               $temp->save();
           }
       }
    }
}
