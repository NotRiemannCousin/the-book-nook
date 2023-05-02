<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'description' => $this->description,
            'language' => $this->language,

            'price' => $this->calcPrice(),
            'real_price' => $this->price,
            'sold' => $this->sold,
            'quantity' => $this->calcQuantity(),

            'image' => $this->image,
            'weight' => $this->weight,
            'size' => [
                'width' => $this->width,
                'height' => $this->height,
                'length' => $this->length,
            ],

            'sale' => ($this->onSale() ? [
                'percentage' => $this->sale?->percentage,
                'until' => $this->sale?->until,
            ] : null),
            // 'sale' => [
            //     $this->mergeWhen($this->onSale(), [
            //         'percentage' => $this->sale?->percentage,
            //         'until' => $this->sale?->until,
            //     ])
            // ],

            'pages' => $this->pages,
            'isbn' => $this->isbn,
            'year' => $this->year,

            'genre' => new GenreResource($this->genre),
            'author' => new AuthorResource($this->author),
            'publisher' => new PublisherResource($this->publisher),

            'rating' => [
                $this->rating_1,
                $this->rating_2,
                $this->rating_3,
                $this->rating_4,
                $this->rating_5
            ],

            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}