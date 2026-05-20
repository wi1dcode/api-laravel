<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShoppingListResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'items' => ItemResource::collection($this->items),
            '_links' => [
                'self' => ['href' => url('/api/list'), 'method' => 'GET'],
                'add_item' => ['href' => url('/api/items'), 'method' => 'POST'],
            ],
        ];
    }
}