<?php

namespace App\Http\Resources;

use App\Models\Listing;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Listing
 */
class ListingResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'reference' => $this->reference,
            'address_line_1' => $this->address_line_1,
            'city' => $this->city,
            'postcode' => $this->postcode,
            'price' => $this->price,
            'bedrooms' => $this->bedrooms,
            'bathrooms' => $this->bathrooms,
            'property_type' => $this->property_type->value,
            'property_type_label' => $this->property_type->label(),
            'status' => $this->status->value,
            'listed_at' => $this->listed_at?->toIso8601String(),
            'branch' => new BranchResource($this->branch),
        ];
    }
}
