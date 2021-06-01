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
        'lastname', 
        'firstname', 
        'middlename', 
        'gender', 
        'birthday', 
        'age', 
        'civil_status', 
        'contact_number', 
        'quantity_family_members', 
        'quantity_dependents', 
        'quantity_working_dependents', 
        'crop_name_planted', 
        'training_name_joined', 
        'highest_educational_status', 
        'college_course', 
        'farming_years', 
        'current_job', 
        'affiliated_organization', 
        'salary_periodicity', 
        'estimated_salary', 
        'social_status', 
        'social_status_reason', 
        'mode_of_application', 
        'updated_at', 
        'created_at'
    ];
    
    use HasFactory;
}
