<?php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use App\Models\FarmerReport\FarmerReport;

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
