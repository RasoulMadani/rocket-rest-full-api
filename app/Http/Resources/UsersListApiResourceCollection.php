<?php

namespace App\Http\Resources;

use App\Http\Resources\Admin\User\UsersListApiResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class UsersListApiResourceCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => UsersListApiResource::collection($this->collection),
            'meta' => [
                'total' => $this->total(),
                'per_page' =>  $this->perPage(),
                'current_page' => $this->currentPage(),
                'last_page' => $this->lastPage(),
                'from' => $this->firstItem(),
                'to' => $this->lastItem()
            ],
            'links'=>[
                'first' =>  $this->url(1),
                'last'=> $this->url($this->lastPage()),
                'prev' => $this->url($this->currentPage()-1),
                'next' => $this->url($this->currentPage()+1)
            ]
        ];
    }
}
