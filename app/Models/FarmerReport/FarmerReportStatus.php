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

    public static function unverified(): FarmerReportStatus
    {
        return FarmerReportStatus::firstWhere('slug', 'unverified');
    }

    public static function valid(): FarmerReportStatus
    {
        return FarmerReportStatus::firstWhere('slug', 'valid');
    }

    public static function invalid(): FarmerReportStatus
    {
        return FarmerReportStatus::firstWhere('slug', 'invalid');
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
