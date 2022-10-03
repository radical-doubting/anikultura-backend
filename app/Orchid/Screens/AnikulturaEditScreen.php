<?php

namespace App\Orchid\Screens;

use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;

abstract class AnikulturaEditScreen extends Screen
{
    protected $createVerb = 'Create';

    protected $editVerb = 'Edit';

    protected $saveMethod = 'save';

    protected $removeMethod = 'remove';

    /**
     * Name of the resource.
     */
    abstract public function resourceName(): string;

    /**
     * Check whether the resource exists.
     */
    abstract public function exists(): bool;

    abstract public function layout(): iterable;

    public function name(): string
    {
        $replace = [
            'resource' => $this->resourceName(),
        ];

        return $this->exists()
            ? __("$this->editVerb :resource", $replace)
            : __("$this->createVerb :resource", $replace);
    }

    public function description(): string
    {
        $replace = [
            'resource' => $this->resourceName(),
        ];

        return $this->exists()
            ? __("$this->editVerb :resource details", $replace)
            : __("$this->createVerb a new :resource", $replace);
    }

    public function commandBar(): array
    {
        $confirmText = __(
            'Once the :resource is deleted, all of its resources and data will be permanently deleted.',
            [
                'resource' => $this->resourceName(),
            ]
        );

        return [
            Button::make(__('Remove'))
                ->icon('trash')
                ->confirm($confirmText)
                ->method($this->removeMethod)
                ->canSee($this->exists()),
            Button::make(__('Save'))
                ->icon('check')
                ->method($this->saveMethod),
        ];
    }
}
