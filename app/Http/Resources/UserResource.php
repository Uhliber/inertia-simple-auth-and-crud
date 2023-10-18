<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class UserResource extends JsonResource
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
            'name' => $this->name,
            'register_date' => $this->created_at->diffForHumans(),
            // $this->mergeWhen(Auth::user()->is($this->resource), [
            //     'email' => $this->email
            // ])
            'can' => [
                'edit' => Auth::user()->can('edit', $this->resource)
            ]
        ];

        // return parent::toArray($request);
    }
}
