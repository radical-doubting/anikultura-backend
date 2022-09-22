<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use App\Models\FarmerReport\FarmerReport;
use Orchid\Platform\Notifications\DashboardMessage;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Screen\Actions\Link;

class SendReadyForHarvestNotification extends Notification
{
    use Queueable;

    public $farmerReport;

    public function __construct(FarmerReport $farmerReport)
    {
        $this->farmerReport = $farmerReport;
        $this->reportId = $farmerReport->id;
    }

    public function via($notifiable)
    {
        return [DashboardChannel::class];
    }

    public function toDashboard($notifiable)
    {
        $fullName = $this->farmerReport->farmer->fullName;
        
        return (new DashboardMessage())
            ->title($fullName . " is ready for harvest!")
            ->message($this->farmerReport->farmland->name,)
            ->action(url('/'));
    }
}
