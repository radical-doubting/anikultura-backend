<?php

namespace App\Orchid\Layouts\FarmerReport;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Upload;
use Orchid\Screen\Layouts\Rows;

class FarmerReportEditPhotoImage extends Rows
{
    /**
     * Used to create the title of a group of form elements.
     *
     * @var string|null
     */
    protected $title;

    /**
     * Get the fields elements to be displayed.
     *
     * @return Field[]
     */
    protected function fields(): array
    {
        return [
            Upload::make('farmer_report.attachment')
                ->title(__('All attachments'))
                ->acceptedFiles('image/*')
                ->storage('local')
                ->groups('photos'),
        ];
    }
}
