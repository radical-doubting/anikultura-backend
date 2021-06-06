<?php

namespace App\Models\Farmer;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use Orchid\Filters\Filterable;

class FarmerProfile extends Model
{
    public $table = 'farmer_profile';
    
    use Filterable, HasFactory, AsSource;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'gender', 
        'civil_status', 
        'birthday', 
        'age', 
        'quantity_family_members', 
        'quantity_dependents', 
        'quantity_working_dependents', 
        'highest_educational_status', 
        'college_course', 
        'current_job', 
        'farming_years', 
        'usual_crops_planted', 
        'affiliated_organization', 
        'tesda_training_joined',
        'nc_passer_status',
        'salary_periodicity', 
        'estimated_salary', 
        'social_status', 
        'social_status_reason', 
        'updated_at', 
        'created_at'
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

    public function farmer_address()
    {
        return $this->hasOne(Farmer_address::class, 'foreign_key');
    }

    public function verification()
    {
        return $this->hasOne(Verification::class, 'foreign_key');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'foreign_key');
    }

    public function farmland()
    {
        return $this->belongsTo(Farmland::class, 'foreign_key');
    }
}