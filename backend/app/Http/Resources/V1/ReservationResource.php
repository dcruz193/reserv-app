<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ReservationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'hotel_id' => $this->hotel_id,
            'hotel_name' => $this->hotel->name,
            'room_type' => $this->room_type,
            'created_at' => $this->created_at,
        ];
    }
}
