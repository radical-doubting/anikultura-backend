<?php

declare(strict_types=1);

namespace App\Orchid\Presenters\User;

class BigBrotherPresenter extends UserPresenter
{
    public function label(): string
    {
        return __('Big Brothers');
    }

    public function subTitle(): string
    {
        return __('Big Brother');
    }

    public function url(): string
    {
        return route('platform.big-brothers.edit', $this->entity);
    }
}
