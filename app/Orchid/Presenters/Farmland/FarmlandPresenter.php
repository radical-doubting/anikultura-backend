<?php

namespace App\Orchid\Presenters\Farmland;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class FarmlandPresenter extends Presenter implements Searchable
{
    public function label(): string
    {
        return __('Farmlands');
    }

    public function title(): string
    {
        return $this->entity->name;
    }

    public function subTitle(): string
    {
        return __('Farmland');
    }

    public function url(): string
    {
        return route('platform.farmlands.edit', $this->entity);
    }

    public function image(): ?string
    {
        return null;
    }

    public function perSearchShow(): int
    {
        return 3;
    }

    public function searchQuery(string $query = null): Builder
    {
        return $this->entity->search($query);
    }
}
