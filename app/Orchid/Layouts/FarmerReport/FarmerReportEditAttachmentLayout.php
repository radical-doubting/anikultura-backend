<?php

namespace App\Orchid\Layouts\FarmerReport;

use Orchid\Screen\Field;
use Orchid\Screen\Fields\Picture;
use Orchid\Screen\Layouts\Rows;

class FarmerReportEditAttachmentLayout extends Rows
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
        $currentReport = $this->query['farmer_report'];
        $media = $currentReport->fetchAllMedia();
        $fileUrl = 'http://placehold.jp/ababab/ffffff/150x150.png?text=No%20image%20attached';

        if (count($media) > 0) {
            $fileUrl = $media[0]->file_url;
        }

        return [
            Picture::make('image')
                ->value($fileUrl)
                ->title('Image Proof')
                ->acceptedFiles('image/*'),
        ];
    }
}
