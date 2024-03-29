<?php

namespace App\Models\Crop;

use App\Models\FarmerReport\FarmerReport;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Orchid\Filters\Filterable;

/**
 * @property string $slug
 */
class SeedStage extends Model
{
    use Filterable, HasFactory, Sluggable;

    protected $fillable = [
        'name',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
        'name',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'name',
    ];

    public static function initialStage(): SeedStage
    {
        return SeedStage::where('slug', 'starter-kit-received')
            ->first();
    }

    public function farmerReport(): HasMany
    {
        return $this->hasMany(FarmerReport::class);
    }

    public function nextStage(): ?SeedStage
    {
        return SeedStage::find($this->id + 1);
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
