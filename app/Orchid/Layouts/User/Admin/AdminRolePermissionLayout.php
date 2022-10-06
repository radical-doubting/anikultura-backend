<?php

declare(strict_types=1);

namespace App\Orchid\Layouts\User\Admin;

use App\Models\User\Admin\Admin;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Illuminate\Support\Collection;
use Orchid\Screen\Fields\CheckBox;
use Orchid\Screen\Fields\Group;

class AdminRolePermissionLayout extends AnikulturaEditLayout
{
    private ?Admin $admin;

    public function fields(): iterable
    {
        $this->admin = $this->query->get('admin');

        return $this->generatedPermissionFields(
            $this->query->getContent('permission')
        );
    }

    /**
     * @param  Collection  $permissionsRaw
     * @return array
     */
    private function generatedPermissionFields(Collection $permissionsRaw): array
    {
        return $permissionsRaw
            ->map(function (Collection $permissions, $title) {
                return $this->makeCheckBoxGroup($permissions, $title);
            })
            ->flatten()
            ->toArray();
    }

    /**
     * @param  Collection  $permissions
     * @param  string  $title
     * @return Collection
     */
    private function makeCheckBoxGroup(Collection $permissions, string $title): Collection
    {
        return $permissions
            ->map(function (array $chunks) {
                return $this->makeCheckBox(collect($chunks));
            })
            ->flatten()
            ->map(function (CheckBox $checkbox, $key) use ($title) {
                return $key === 0
                    ? $checkbox->title($title)
                    : $checkbox;
            })
            ->chunk(4)
            ->map(function (Collection $checkboxes) {
                return Group::make($checkboxes->toArray())
                    ->alignEnd()
                    ->autoWidth();
            });
    }

    /**
     * @param  Collection  $chunks
     * @return CheckBox
     */
    private function makeCheckBox(Collection $chunks): CheckBox
    {
        return CheckBox::make('admin.permissions.'.base64_encode($chunks->get('slug')))
            ->placeholder($chunks->get('description'))
            ->value($chunks->get('active'))
            ->sendTrueOrFalse()
            ->indeterminate($this->getIndeterminateStatus(
                $chunks->get('slug'),
                $chunks->get('active')
            ));
    }

    /**
     * @param $slug
     * @param $value
     * @return bool
     */
    private function getIndeterminateStatus($slug, $value): bool
    {
        return optional($this->admin)->hasAccess($slug) === true && $value === false;
    }
}
