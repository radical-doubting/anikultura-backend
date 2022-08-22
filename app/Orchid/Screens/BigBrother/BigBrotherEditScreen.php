<?php

namespace App\Orchid\Screens\BigBrother;

use App\Actions\BigBrother\CreateBigBrother;
use App\Actions\BigBrother\DeleteBigBrother;
use App\Models\BigBrother\BigBrother;
use App\Orchid\Layouts\BigBrother\BigBrotherEditLayout;
use App\Orchid\Layouts\User\UserEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
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
            'user' => $bigBrother,
            'big_brother_profile' => $bigBrother->profile,
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
            Layout::block(UserEditLayout::class)
                ->title('Account Information')
                ->description("This information collects big brother's account information."),

            Layout::block(BigBrotherEditLayout::class)
                ->title(__('Basic Information'))
                ->description(__('Update big brother\'s  information')),
        ];
    }

    /**
     * Remove a bigBrother.
     *
     * @param  BigBrother  $bigBrother
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(BigBrother $bigBrother)
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }

    /**
     * Save a bigBrother.
     *
     * @param  BigBrother  $bigBrother
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(BigBrother $bigBrother, Request $request)
    {
        return CreateBigBrother::runOrchidAction($bigBrother, $request);
    }
}
