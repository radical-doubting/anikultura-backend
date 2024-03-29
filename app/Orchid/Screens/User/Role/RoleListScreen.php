<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User\Role;

use App\Models\User\Role;
use App\Orchid\Layouts\User\Role\RoleListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class RoleListScreen extends Screen
{
    /**
     * Display header name.
     *
     * @var string
     */
    public $name = 'Manage roles';

    /**
     * Display header description.
     *
     * @var string
     */
    public $description = 'Access rights';

    /**
     * @var string
     */
    public $permission = 'platform.roles';

    /**
     * Query data.
     *
     * @return array
     */
    public function query(): array
    {
        $this->authorize('viewAny', Role::class);

        return [
            'roles' => Role::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        return [
            Link::make(__('Add'))
                ->icon('plus')
                ->href(route('platform.roles.create')),
        ];
    }

    /**
     * Views.
     *
     * @return string[]|\Orchid\Screen\Layout[]
     */
    public function layout(): array
    {
        return [
            RoleListLayout::class,
        ];
    }
}
