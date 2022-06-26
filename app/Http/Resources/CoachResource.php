<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CoachResource extends JsonResource
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
            "id" => $this->id,
            "name" => $this->name,
            "lastName" => $this->lastName,
            "nationality" => $this->nationality,
            "dateOfBirth" => $this->dateOfBirth,
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
