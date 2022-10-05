<?php

namespace App\Orchid\Screens\User\BigBrother;

use App\Actions\User\BigBrother\CreateBigBrother;
use App\Actions\User\BigBrother\DeleteBigBrother;
use App\Models\User\BigBrother\BigBrother;
use App\Models\User\BigBrother\BigBrotherProfile;
use App\Orchid\Layouts\User\BigBrother\BigBrotherEditAccountLayout;
use App\Orchid\Layouts\User\BigBrother\BigBrotherEditLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class BigBrotherEditScreen extends AnikulturaEditScreen
{
    public BigBrother $bigBrother;

    public ?BigBrotherProfile $bigBrotherProfile;

    public function resourceName(): string
    {
        return __('big brother');
    }

    public function exists(): bool
    {
        return $this->bigBrother->exists;
    }

    public function query(BigBrother $bigBrother): array
    {
        return [
            'bigBrother' => $bigBrother,
            'bigBrotherProfile' => $bigBrother->profile,
        ];
    }

    public function layout(): iterable
    {
        $tabs = [
            __('Account Information') => [
                Layout::block(BigBrotherEditAccountLayout::class)
                    ->title(__('Account Information'))
                    ->description(__('This information collects big brother\'s account information.'))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],

            __('Profile Information') => [
                Layout::block(BigBrotherEditLayout::class)
                    ->title(__('Personal Information'))
                    ->description(__('Update big brother\'s  information'))
                    ->commands(
                        Button::make(__('Save'))
                            ->type(Color::DEFAULT())
                            ->icon('check')
                            ->method('save')
                    ),
            ],
        ];

        return [
            Layout::tabs($tabs)->activeTab(__('Account Information')),
        ];
    }

    public function remove(BigBrother $bigBrother): RedirectResponse
    {
        return DeleteBigBrother::runOrchidAction($bigBrother, null);
    }

    public function save(BigBrother $bigBrother, Request $request): RedirectResponse
    {
        return CreateBigBrother::runOrchidAction($bigBrother, $request);
    }
}
