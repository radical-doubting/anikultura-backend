<?php

namespace App\Orchid\Screens\Batch;

use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Color;
use Orchid\Screen\Actions\Button;
use App\Orchid\Layouts\Batch\BatchEditLayout;
use App\Models\Batch\Batches;
use App\Orchid\Layouts\Batch\AddFarmersLayout;
use App\Orchid\Layouts\Batch\AddSiteLayout;
use Orchid\Support\Facades\Toast;
use Illuminate\Http\Request;

class BatchEditScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Edit Batch';

    /**
     * Display header description.
     *
     * @var string|null
     */
    public $description = 'Edit a batch under KSK SAP';
    
   
    /**
     * 
     * 
     *
     * Query data.
     *
     * @return array
     */
    public function query(Batches $batches): array
    {
        $this->batches = $batches;

        if(!$batches->exists){
            $this->name = 'Create Batch';
            $this->description = 'Create a new batch';
        }

        return [   
           //'batches'=>Batches::all()
           'batches' => $batches
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
                ->confirm(__('Once the batch is deleted, all of its resouces and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.'))
                ->method('remove')
                ->canSee($this->batches->exists),

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
            //BatcheditLayout class
            Layout::block(BatchEditLayout::class)
            ->title(__('Batch Information'))
            ->description(__('Update your batch\'s information.')),
            
            //AddSiteLayout::class
            Layout::block(AddSiteLayout::class)
            ->title(__('Batch Site'))
            ->description(__('Enter where is the assigned site of the batch')),
            

            //AddFarmersLayout::class
            Layout::block(AddFarmersLayout::class)
            ->title(__('Enrolled Farmers'))
            ->description(__('Add Farmers included in the batch.'))
        ];
    }

    /**
     * @param Batches $batches
     *
     * @throws \Exception
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(Batches $batches)
    {
        $batches->delete();

        Toast::info(__('Batch was removed'));

        return redirect()->route('platform.batches');
    }

    /**
     * @param Batches    $batches
     * @param Request $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Batches $batches, Request $request)
    {
        $request->validate([
            'batches.assigned_farmschool_name' => [
                'required'
            ],
            'batches.number_seeds_distributed' => [
                'required'
            ],

            'batches.region_id' => [
                'required'
            ],

            'batches.province_id' => [
                'required'
            ],

            'batches.municity_id' => [
                'required'
            ],

            'batches.farmers' => [
                'required',
                'array'
            ],
        ]);

        $batchesData = $request->get('batches');

        $batches
            ->fill($batchesData)
            ->save();
        
        $batches
            ->farmers()
            ->sync($batchesData['farmers']);
            
        Toast::info(__('Batch was saved successfully.'));

        return redirect()->route('platform.batches');
    }
}
