<?php

namespace App\Http\Resources;

use App\Http\Resources\Booking as BookingResource;
use Illuminate\Http\Resources\Json\JsonResource;

class Booked extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return BookingResource::collection($this->booked());
    }
}