<?php

namespace App\Http\Services;

class ApiService
{
    /**
     * @var string
     */
    private $baseUrl;

    /**
     * @var array
     */
    private $reqPrefs = [];
    /**
     * @var string[]
     */
    private $codes = ['PD', 'PL', 'SA', 'FL1', 'BL1'];
    /**
     *
     */
    public function __construct()
    {
        $this->baseUrl = config('services.api_service.url');
        $this->reqPrefs['http']['method'] = 'GET';
        $this->reqPrefs['http']['header'] = 'X-Auth-Token: ' . config('services.api_service.token');
    }

    /**
     * Get actives Competitions
     * @param null $id
     * @return array|Object
     */
    public function getCompetitions($id = null): array | Object
    {
        $resource = null != $id ? 'competitions/'.$id : 'competitions';
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));
        $data = json_decode($response);
        $result = [];
        if(!$id){
            foreach ($data->competitions as $competition){
                if(in_array($competition->code, $this->codes)){
                    $result[] = $competition;
                }
            }
        }else{
            $result = $data;
        }

        return $result;
    }

    /**
     * Function returns a particular competition identified by an id.
     *
     * @param Integer $id
     * @return array
     */
    public function findCompetitionById(int $id): array
    {
        $resource = 'competitions/' . $id;
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * Function returns a particular competition identified by an id.
     *
     * @param int $competitionId
     * @param Integer|null $id
     * @return array|Object
     */
    public function findTeams(int $competitionId, int $id = null): array | Object
    {
        $resource = null != $id ? 'competitions/'.$competitionId.'/teams/' . $id : 'competitions/'.$competitionId.'/teams';
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * Function returns a particular competition identified by an id.
     *
     * @param int $competitionId
     * @param Integer|null $id
     * @return array
     */
    public function findSeasons(int $competitionId, int $id = null): array
    {
        $resource = null != $id ? 'competitions/'.$competitionId.'/teams/' . $id : 'competitions/'.$competitionId.'/teams';
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * Function returns all available matches for a given date range.
     *
     * @param 'DateString' 'Y-m-d' $start
     * @param 'DateString' 'Y-m-d' $end
     *
     * @return array of matches
     */
    public function findMatchesForDateRange($start, $end): array
    {
        $resource = 'matches/?dateFrom=' . $start . '&dateTo=' . $end;

        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * @param $c
     * @param $m
     * @return mixed
     */
    public function findMatchesByCompetitionAndMatchday($c, $m): mixed
    {
        $resource = 'competitions/' . $c . '/matches/?matchday=' . $m;

        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * @param $c
     * @param $season
     * @return mixed
     */
    public function findMatchesByCompetition($c, $season): mixed
    {
        $resource = 'competitions/' . $c . '/matches/?season=' . $season;

        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function findStandingsByCompetition($id): mixed
    {
        $resource = 'competitions/' . $id . '/standings';
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * @param $teamId
     * @return mixed
     */
    public function findHomeMatchesByTeam($teamId): mixed
    {
        $resource = 'teams/' . $teamId . '/matches/?venue=HOME';
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response)->matches;
    }

    /**
     * Function returns one unique match identified by a given id.
     *
     * @param int $id
     * @return Object fixture
     */
    public function findMatchById(int $id): object
    {
        $resource = 'matches/' . $id;
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * Function returns one unique team identified by a given id.
     *
     * @param int $id
     * @return Object team
     */
    public function findTeamById(int $id): object
    {
        $resource = 'teams/' . $id;
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }

    /**
     * Function returns all teams matching a given keyword.
     *
     * @param string $keyword
     * return list of team objects
     */
    public function searchTeam(string $keyword) {
        $resource = 'teams/?name=' . $keyword;
        $response = file_get_contents($this->baseUrl . $resource, false,
            stream_context_create($this->reqPrefs));

        return json_decode($response);
    }
}
