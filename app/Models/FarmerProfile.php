<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Filters\Filterable;

class FarmerProfile extends Model
{
    use Filterable, HasFactory;
    protected $fillable = [
        'id',
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
        'social_status_reason'
    ];
}
