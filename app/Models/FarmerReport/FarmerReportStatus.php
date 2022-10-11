<?php

namespace App\Models\FarmerReport;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Model;

class FarmerReportStatus extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
    ];

    public static function valid(): FarmerReportStatus
    {
        return FarmerReportStatus::firstWhere('slug', 'valid');
    }

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
            ],
        ];
    }
}
