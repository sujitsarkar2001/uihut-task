<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $preview_images = [];
        foreach ($this->preview_images as $image) {
            $preview_images[] = uploadedFile($image);
        }
        
        return [
            'id'             => $this->id,
            'name'           => $this->name,
            'thumbnail'      => uploadedFile($this->thumbnail),
            'preview_images' => $preview_images,
            'categories'     => new CategoryCollection($this->categories),
        ];
    }
}
