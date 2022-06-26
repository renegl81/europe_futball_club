<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SeasonResource extends JsonResource
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
            'year' => $this->year,
            'currentMatchday' => $this->currentMatchday,
            'league' => new LeagueResource($this->league),
            'winner' => $this->winner ? new TeamResource($this->winner) : null,
            'startDate' => $this->startDate,
            'endDate' => $this->endDate,

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
