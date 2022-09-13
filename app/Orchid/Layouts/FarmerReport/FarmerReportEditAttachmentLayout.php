<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Picture;

class FarmerReportEditAttachmentLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
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
