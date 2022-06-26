<?php

namespace App\Console\Commands;

use App\Http\Services\ApiService;
use App\Models\Season;
use Illuminate\Console\Command;

class GetGamesCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:name';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * @var ApiService
     */
    private $apiService;

    /**
     * @param ApiService $apiService
     */
    public function __construct(ApiService $apiService)
    {
        parent::__construct();
        $this->apiService = $apiService;
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $code = 'PD';
        $season = Season::whereHas('league', function ($q) use ($code){
            $q->where('code', $code)->first();
        })->where('year', '2021-2022');
    }
}
