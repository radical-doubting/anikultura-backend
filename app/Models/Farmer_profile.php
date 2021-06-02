<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Farmer_profile extends Model
{
    public $table = 'farmer_profile';

    use AsSource;
    
    protected $fillable = [
        'gender', 
        'civil_status', 
        'birthday', 
        'age', 
        'quantity_family_members', 
        'quantity_dependents', 
        'quantity_working_dependents', 
        'trainings_joined', 
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
    
    use HasFactory;
}