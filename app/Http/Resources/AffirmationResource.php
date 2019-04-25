<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AffirmationResource extends JsonResource
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
            'Id' => $this->id,
            'Affirmation' => $this->aff_content,
            'Categories' => $this->CatList()->get()->pluck('category_title'),            
        ];
    }
}
