<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'author' => strtoupper($this->author),
            'summary' => $this->summary,
            'isbn' => $this->isbn,
            '_links' => [
                'self' => ['href' => route('books.show', $this->id), 'method' => 'GET'],
                'update' => ['href' => route('books.update', $this->id), 'method' => 'PUT'],
                'delete' => ['href' => route('books.destroy', $this->id), 'method' => 'DELETE'],
                'all' => ['href' => route('books.index'), 'method' => 'GET'],
            ],
        ];
    }
}