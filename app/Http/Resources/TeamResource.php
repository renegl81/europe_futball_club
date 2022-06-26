<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'club' => new ClubResource($this->club),
            'coach' => $this->coach ? new CoachResource($this->coach) : null,
            'stadium' => $this->stadium ? new StadiumResource($this->stadium) : null,
            'season' => new SeasonResource($this->season),
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
