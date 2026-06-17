<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'project_id' => $this->project_id,
            'contractor_id' => $this->contractor_id,
            'project' => new ProjectResource($this->whenLoaded('project')),
            'contractor' => new ContractorResource($this->whenLoaded('contractor')),
            'amount' => $this->amount,
            'date' => $this->date,
            'description' => $this->description,
            'created_at' => $this->created_at->toIso8601String(),
        ];
    }
}
