<?php

namespace App\Orchid\Screens\FarmerReport;

use App\Models\Crop;
use App\Models\FarmerReport;
use App\Orchid\Layouts\FarmerReport\FarmerReportEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

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
        $this->farmer_report = $farmer_report;

        if (!$farmer_report->exists) {
            $this->name = 'Create Farmer Report';
            $this->description = 'Create a new farmer report';
        }

        return [
            'farmer_report' => $farmer_report
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
            Layout::block(FarmerReportEditLayout::class)
                ->title(__('Report Information'))
                ->description(__('Update the report\'s  information'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->canSee($this->farmer_report->exists)
                        ->method('save')
                ),
        ];
    }

    //Delete function
    public function remove(FarmerReport $farmer_report)
    {
        $farmer_report->delete();

        Toast::info(__('Farmer report was removed'));

        return redirect()->route('platform.farmer.reports');
    }

    //Save function
    public function save(FarmerReport $farmer_report, Request $request)
    {
        $request->validate([
            'farmer_report.farmer_id' => [
                'required',
            ],
            'farmer_report.farmland_id' => [
                'required',
            ],
            'farmer_report.seed_stage_id' => [
                'required',
            ],
            'farmer_report.crop_id' => [
                'required',
            ],
            'farmer_report.volume' => [
                'required',
            ]
        ]);

        $report_data = $request->get('farmer_report');

        $farmer_report
            ->fill($report_data)
            ->save();

        Toast::info(__('Farmer report was saved.'));

        return redirect()->route('platform.farmer.reports');
    }
}
