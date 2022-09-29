<?php

declare(strict_types=1);

namespace App\Orchid\Presenters;

use Laravel\Scout\Builder;
use Orchid\Screen\Contracts\Personable;
use Orchid\Screen\Contracts\Searchable;
use Orchid\Support\Presenter;

class UserPresenter extends Presenter implements Searchable, Personable
{
    public function label(): string
    {
        return 'Users';
    }

    public function title(): string
    {
        $fullName = $this->entity->fullName;

        return is_null($fullName) ? $this->entity->name : $fullName;
    }

    public function subTitle(): string
    {
        $roles = $this->entity->roles->pluck('name')->implode(' / ');

        return empty($roles)
            ? __('No role')
            : $roles;
    }

    public function url(): string
    {
        return route('platform.systems.users.edit', $this->entity);
    }

    public function image(): ?string
    {
        $hash = md5(strtolower(trim($this->entity->email)));

        return "https://source.boringavatars.com/beam/120/$hash?colors=A69A90,4A403D,FFF1C1,FACF7D,EA804C";
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
