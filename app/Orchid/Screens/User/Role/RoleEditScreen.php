<?php

declare(strict_types=1);

namespace App\Orchid\Screens\User\Role;

use App\Actions\User\Role\CreateRole;
use App\Actions\User\Role\DeleteRole;
use App\Models\User\Role;
use App\Orchid\Layouts\User\Role\RoleEditLayout;
use App\Orchid\Layouts\User\Role\RolePermissionLayout;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;

class RoleEditScreen extends Screen
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
     * @var bool
     */
    private $exist = false;

    /**
     * Query data.
     *
     * @param  Role  $role
     * @return array
     */
    public function query(Role $role): array
    {
        $this->authorize('view', $role);

        $this->exist = $role->exists;

        return [
            'role' => $role,
            'permission' => $role->getStatusPermission(),
        ];
    }

    /**
     * Button commands.
     *
     * @return Action[]
     */
    public function commandBar(): array
    {
        $confirmText = __(
            'This is an extremely destructive action! Once the role is deleted, all users with this role will lose permission to access the system entirely.',
            [
                'resource' => 'role',
            ]
        );

        return [
            Button::make(__('Remove'))
                ->type(Color::DANGER())
                ->icon('trash')
                ->confirm($confirmText)
                ->method('remove')
                ->canSee($this->exist),

            Button::make(__('Save'))
                ->icon('check')
                ->method('save'),
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
            Layout::block([
                RoleEditLayout::class,
            ])
                ->title(__('Role'))
                ->description(__('A role is a collection of privileges (of possibly different services like the Users service, Moderator, and so on) that grants users with that role the ability to perform certain tasks or operations.')),

            Layout::block([
                RolePermissionLayout::class,
            ])
                ->title(__('Permission/Privilege'))
                ->description(__('A privilege is necessary to perform certain tasks and operations in an area.')),
        ];
    }

    /**
     * @param  Role  $role
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function save(Role $role, Request $request): RedirectResponse
    {
        return CreateRole::runOrchidAction($role, $request);
    }

    /**
     * @param  Role  $role
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Exception
     */
    public function remove(Role $role, Request $request): RedirectResponse
    {
        return DeleteRole::runOrchidAction($role, $request);
    }
}
