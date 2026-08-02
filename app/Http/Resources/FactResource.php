<?php

namespace App\Http\Resources;

use App\Models\Fact;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/** @mixin Fact */
class FactResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'text' => $this->text,
            'category' => $this->category,
            'source' => $this->source,
            'source_url' => $this->source_url,
            'year' => $this->year,
        ];
    }
}
