<?php

namespace App\Console\Commands;

use App\Http\Services\ApiService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class LeagueCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get_leagues {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get league data';

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
     * @return array
     */
    public function handle(): array
    {
       return $this->apiService->getCompetitions();
    }
}
