<?php

namespace App\Orchid\Screens\BigBrother;

use App\Actions\BigBrother\CreateBigBrother;
use App\Actions\BigBrother\DeleteBigBrother;
use App\Models\BigBrother\BigBrother;
use App\Models\BigBrother\BigBrotherProfile;
use App\Orchid\Layouts\BigBrother\BigBrotherEditAccountLayout;
use App\Orchid\Layouts\BigBrother\BigBrotherEditLayout;
use App\Orchid\Screens\AnikulturaEditScreen;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
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
            'bigBrotherProfile' => $bigBrother?->profile,
        ];
    }

    public function layout(): iterable
    {
        return [
            Layout::block(BigBrotherEditAccountLayout::class)
                ->title(__('Account Information'))
                ->description(__('This information collects big brother\'s account information.')),

            Layout::block(BigBrotherEditLayout::class)
                ->title(__('Basic Information'))
                ->description(__('Update big brother\'s  information')),
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
