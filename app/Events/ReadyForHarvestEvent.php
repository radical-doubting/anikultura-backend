<?php

namespace App\Events;

use App\Models\FarmerReport\FarmerReport;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ReadyForHarvestEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $farmerReport;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(FarmerReport $farmerReport)
    {
        $this->farmerReport = $farmerReport;
    }
}
