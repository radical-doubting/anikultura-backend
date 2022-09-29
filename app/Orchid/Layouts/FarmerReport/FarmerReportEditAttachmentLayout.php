<?php

namespace App\Orchid\Layouts\FarmerReport;

use App\Models\FarmerReport\FarmerReport;
use App\Orchid\Layouts\AnikulturaEditLayout;
use Orchid\Screen\Fields\Picture;

class FarmerReportEditAttachmentLayout extends AnikulturaEditLayout
{
    protected function fields(): iterable
    {
        /**
         * @var FarmerReport
         */
        $currentReport = $this->query->get('farmerReport');

        return [
            Picture::make('image')
                ->value($this->getPhotoUrl($currentReport))
                ->title('Image Proof')
                ->acceptedFiles('image/*'),
        ];
    }

    private function getPhotoUrl(FarmerReport $farmerReport): string
    {
        $photoUrl = $farmerReport->photo_url;
        $placeholderUrl = 'http://placehold.jp/ababab/ffffff/150x150.png?text=No%20image%20attached';

        return is_null($photoUrl) ? $placeholderUrl : $photoUrl;
    }
}
