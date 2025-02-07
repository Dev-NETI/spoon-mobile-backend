<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TopRecipeResource extends JsonResource
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
            'name' => $this->name,
            'imagePath' => $this->image_path,
            'mealType' => $this->meal_type->name,
            'flag' => $this->recipe_origin->image_path,
            'origin' => $this->recipe_origin->name,
        ];
    }
}
