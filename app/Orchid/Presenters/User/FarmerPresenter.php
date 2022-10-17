<?php

declare(strict_types=1);

namespace App\Orchid\Presenters\User;

class FarmerPresenter extends UserPresenter
{
    public function label(): string
    {
        return __('Farmers');
    }

    public function subTitle(): string
    {
        return __('Farmer');
    }

    public function url(): string
    {
        return route('platform.farmers.edit', $this->entity);
    }
}
