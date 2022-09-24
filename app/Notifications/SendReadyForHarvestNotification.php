<?php

namespace App\Notifications;

use App\Models\FarmerReport\FarmerReport;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Orchid\Platform\Notifications\DashboardChannel;
use Orchid\Platform\Notifications\DashboardMessage;

class SendReadyForHarvestNotification extends Notification
{
    use Queueable;

    protected $target = 'farmer_reports';

    public $farmerReport;

    public function __construct(FarmerReport $farmerReport)
    {
        $this->farmerReport = $farmerReport;
    }

    public function via($notifiable)
    {
        return [DashboardChannel::class];
    }

    public function toDashboard($notifiable)
    {
        $fullName = $this->farmerReport->farmer->fullName;

        return (new DashboardMessage())
            ->title($fullName.' is ready for harvest!')
            ->message($this->farmerReport->farmland->name)
            ->action(route('platform.farmer-reports.edit', [$this->farmerReport->id]));
    }
}
