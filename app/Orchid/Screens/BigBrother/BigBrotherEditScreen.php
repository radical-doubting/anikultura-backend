<?php

namespace App\Orchid\Screens\BigBrother;

use App\Actions\BigBrother\CreateBigBrother;
use App\Actions\BigBrother\DeleteBigBrother;
use App\Models\BigBrother\BigBrother;
use App\Orchid\Layouts\BigBrother\BigBrotherEditBasicLayout;
use App\Orchid\Layouts\BigBrother\BigBrotherEditGrowthLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class BigBrotherEditScreen extends Screen
{
    protected $exists = false;

    public function __construct()
    {
        $this->name = __('Create Big Brother');
        $this->description = __('Create a new big brother');
    }

    /**
     * Query data.
     *
     * @return array
     */
    public function query(BigBrother $bigBrother): array
    {
        $this->exists = $bigBrother->exists;

        if ($this->exists) {
            $this->name = __('Edit Big Brother');
            $this->description = __('Edit big brother details');
        }

        return [
            'big_brother' => $bigBrother,
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
                ->confirm(__('Once the bigBrother type is deleted, all of its resources and data will be permanently deleted.'))
                ->method('remove')
                ->canSee($this->exists),

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
            Layout::block(BigBrotherEditBasicLayout::class)
                ->title(__('Basic Information'))
                ->description(__('Update your bigBrother\'s  information')),

            Layout::block(BigBrotherEditGrowthLayout::class)
                ->title(__('Growth Information'))
                ->description(__('Update your bigBrother growth rate information'))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::DEFAULT())
                        ->icon('check')
                        ->method('save')
                ),
        ];
    }

    /**
     * Remove a bigBrother.
     *
     * @param BigBrother $bigBrother
     * @throws \Exception
     * @return \Illuminate\Http\RedirectResponse
     */
    public function remove(BigBrother $bigBrother)
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }

    /**
     * Save a bigBrother.
     *
     * @param BigBrother    $bigBrother
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(BigBrother $bigBrother, Request $request)
    {
        return CreateBigBrother::runOrchidAction($bigBrother, $request);
    }
}
