<?php

declare(strict_types=1);

namespace App\Orchid\Presenters;

class FarmerPresenter extends UserPresenter
{
    public function label(): string
    {
        return 'Farmers';
    }

    public function subTitle(): string
    {
        return 'Farmer';
    }

    public function url(): string
    {
        return route('platform.farmers.edit', $this->entity);
    }
}
