<?php

namespace App\Models\Farmer;

use App\Traits\Loggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Orchid\Filters\Filterable;
use Orchid\Screen\AsSource;

class FarmerProfile extends Model
{
    use Filterable, HasFactory, AsSource, Loggable;

    protected $fillable = [
        'gender_id',
        'civil_status_id',
        'birthday',
        'quantity_family_members',
        'quantity_dependents',
        'quantity_working_dependents',
        'educational_status_id',
        'college_course',
        'current_job',
        'farming_years',
        'usual_crops_planted',
        'affiliated_organization',
        'tesda_training_joined',
        'nc_passer_status_id',
        'salary_periodicity_id',
        'estimated_salary',
        'social_status_id',
        'social_status_reason',
        'updated_at',
        'created_at',
    ];

    /**
     * The attributes for which you can use filters in url.
     *
     * @var array
     */
    protected $allowedFilters = [
        'id',
    ];

    /**
     * The attributes for which can use sort in url.
     *
     * @var array
     */
    protected $allowedSorts = [
        'id',
        'updated_at',
        'created_at',
    ];

    protected $casts = [
        'estimated_salary' => 'float',
    ];

    public function farmerAddress(): HasOne
    {
        return $this->hasOne(FarmerAddress::class);
    }

    public function gender(): BelongsTo
    {
        return $this->belongsTo(Gender::class);
    }

    public function civilStatus(): BelongsTo
    {
        return $this->belongsTo(CivilStatus::class);
    }

    public function educationalStatus(): BelongsTo
    {
        return $this->belongsTo(EducationalStatus::class);
    }

    public function salaryPeriodicity(): BelongsTo
    {
        return $this->belongsTo(SalaryPeriodicity::class);
    }

    public function socialStatus(): BelongsTo
    {
        return $this->belongsTo(SocialStatus::class);
    }

    public function ncPasserStatus(): BelongsTo
    {
        return $this->belongsTo(NCPasserStatus::class);
    }

    public function preference(): HasOne
    {
        return $this->hasOne(FarmerPreference::class);
    }

    public function user(): MorphOne
    {
        return $this->morphOne(Farmer::class, 'profile');
    }
}
