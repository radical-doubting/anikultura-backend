<?php

namespace App\Orchid\Screens\FarmerReport;

use App\Actions\FarmerReport\CreateFarmerReport;
use App\Actions\FarmerReport\DeleteFarmerReport;
use App\Models\FarmerReport\FarmerReport;
use App\Models\User\User;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditAttachmentLayout;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditEstimationLayout;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditInfoLayout;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditVerificationLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FarmerReportEditScreen extends AnikulturaEditScreen
{
    public FarmerReport $farmerReport;

    public function resourceName(): string
    {
        return __('farmer report');
    }

    public function exists(): bool
    {
        return $this->farmerReport->exists;
    }

    public function query(FarmerReport $farmerReport): array
    {
        return [
            'farmerReport' => $farmerReport,
        ];
    }

    public function canSeeRemove(): bool
    {
        /**
         * @var User
         */
        $user = auth()->user();

        return $this->exists() && $user->can('delete', $this->farmerReport);
    }

    public function layout(): iterable
    {
        $tabs = [
            __('Report Information') => [
                Layout::block(FarmerReportEditInfoLayout::class)
                    ->title(__('Report Information'))
                    ->description(__('Update the report information')),
                Layout::block(FarmerReportEditVerificationLayout::class)
                    ->title(__('Verification'))
                    ->description(__('Update the report verification status'))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->canSee($this->exists())
                            ->method('save')
                    ),
            ],
            __('Attachment Information') => [
                Layout::block(FarmerReportEditAttachmentLayout::class)
                    ->title(__('Attachment Information'))
                    ->description(__('View the report attachments')),
            ],
            __('Estimation Information') => [
                Layout::block(FarmerReportEditEstimationLayout::class)
                    ->title(__('Estimation Information'))
                    ->description(__('Read the report estimations')),
            ],
        ];

        return [
            Layout::tabs($tabs)->activeTab(__('Report Information')),
        ];
    }

    public function save(FarmerReport $farmerReport, Request $request): RedirectResponse
    {
        return CreateFarmerReport::runOrchidAction($farmerReport, $request);
    }

    public function remove(FarmerReport $farmerReport, Request $request): RedirectResponse
    {
        return DeleteFarmerReport::runOrchidAction($farmerReport, $request);
    }
}
