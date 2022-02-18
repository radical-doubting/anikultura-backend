<?php

namespace App\Orchid\Screens\FarmerReport;

use App\Actions\FarmerReport\CreateFarmerReport;
use App\Actions\FarmerReport\DeleteFarmerReport;
use App\Models\FarmerReport\FarmerReport;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditInfoLayout;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditPhotoImage;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditVerificationLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class FarmerReportEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Farmer Report';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit a submitted farmer report';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(FarmerReport $farmer_report): array
    {
        $farmer_report->load('attachment');

        $this->farmer_report = $farmer_report;

        if (!$farmer_report->exists) {
            $this->name = 'Create Farmer Report';
            $this->description = 'Create a new farmer report';
        }

        return [
            'farmer_report' => $farmer_report,
        ];
    }

    /**
     * Button commands.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): array
    {
        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm(__('Once the farmer report is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->farmer_report->exists),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
        ];
    }

    /**
     * Views.
     *
     * @return \Orchid\Screen\Layout[]|string[]
     */
    public function layout(): array
    {
        return [
            Layout::block(FarmerReportEditInfoLayout::class)
                ->title(__('Report Information'))
                ->description(__('Update the report information')),
            Layout::block(FarmerReportEditPhotoImage::class)
                ->title(__('Attachment Information'))
                ->description(__('Update the report attachments')),
            Layout::block(FarmerReportEditVerificationLayout::class)
                ->title(__('Verification'))
                ->description(__('Update the report verification status'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->farmer_report->exists)
                        ->method('save')
                ),
        ];
    }

    /**
     * Save a farmer report.
     *
     * @param FarmerReport $farmerReport
     * @param Request      $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(FarmerReport $farmerReport, Request $request)
    {
        return CreateFarmerReport::runOrchidAction($farmerReport, $request);
    }

    /**
     * Remove a farmer report.
     *
     * @param FarmerReport $farmerReport
     * @param Request      $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(FarmerReport $farmerReport)
    {
        return DeleteFarmerReport::runOrchidAction($farmerReport, null);
    }
}
