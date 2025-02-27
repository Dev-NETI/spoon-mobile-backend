<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SavedRecipeResources extends JsonResource
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
            'name' => $this->recipe->name,
            'imagePath' => $this->recipe->image_path,
            'mealType' => $this->recipe->meal_type->name,
            'flag' => $this->recipe->recipe_origin->image_path,
            'origin' => $this->recipe->recipe_origin->name,
        ];
    }
}
