<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\FarmerReport\FarmerReport;
class SendReadyForHarvestNotification extends Notification
{
    use Queueable;

    public $farmerReport;

    public function __construct(FarmerReport $farmerReport)
    {
        $this->farmerReport = $farmerReport;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'seedStageSlug' => $this->farmerReport->seedStage->slug,
            'farmlandLocation' => $this->farmerReport->farmland->name,
            'farmerLastName' => $this->farmerReport->farmer->last_name,
            'farmerMiddleName' => $this->farmerReport->farmer->middle_name,
            'farmerFirstName' => $this->farmerReport->farmer->first_name,
        ];
    }
}
