<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class GameResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'api_id' => $this->api_id,
            'season_id' => new SeasonResource($this->resource),
            'home_id' => new TeamResource($this->home),
            'away_id' => new TeamResource($this->away),
            'day' => $this->day,
            'status' => $this->status,
            'stage' => $this->stage,
            'group' => $this->group,
            'matchDay' => $this->matchDay,
            'winner' => $this->winner,
            'homeScore' => $this->homeScore,
            'awayScore' => $this->awayScore,
            'homeHalfScore' => $this->homeHalfScore,
            'awayHalfScore' => $this->awayHalfScore
        ];
    }

    /**
     * @param $entities
     * @return array
     */
    public static function arrayCollection($entities): array
    {
        $output = [];
        foreach ($entities as $entity) {
            $output[] = (new self($entity))->toArray($entity);
        }

        return $output;
    }
}
