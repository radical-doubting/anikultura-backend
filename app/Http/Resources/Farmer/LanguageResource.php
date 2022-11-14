<?php

namespace App\Http\Resources\Farmer;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin \App\Models\User\Farmer\Farmer
 */
class LanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'language' => $this->preferredLocale(),
        ];
    }
}
