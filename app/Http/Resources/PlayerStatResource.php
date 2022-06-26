<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PlayerStatResource extends JsonResource
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
            'player' =>  new TeamResource($this->player),
            'goals' => $this->goals,
            'penalties' => $this->penalties,
            'assists' => $this->assists,
            'yellowCards' => $this->yellowCards,
            'redCards' => $this->redCards,
            'foulsCommitted' => $this->foulsCommitted,
            'foulsReceived' => $this->foulsReceived,
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
