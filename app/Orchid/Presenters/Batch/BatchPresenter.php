<?php

namespace App\Orchid\Presenters\Batch;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class BatchPresenter extends Presenter implements Searchable
{
    public function label(): string
    {
        return __('Batches');
    }

    public function title(): string
    {
        return $this->entity->farmschool_name;
    }

    public function subTitle(): string
    {
        return __('Batch');
    }

    public function url(): string
    {
        return route('platform.batches.edit', $this->entity);
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
