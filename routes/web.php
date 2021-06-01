<?php

use Illuminate\Support\Facades\Route;
use App\Models\farmer_profile;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/profile', function () {
    return view('profile');
});

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/test-create', function () {
    farmer_profile::create([
        'lastname' => 'Da Anton',
        'firstname' => 'Steven',
        'middlename' => 'J',
        'gender' => 'Male',
        'birthday' => '1898-06-12',
        'age' => 122,
        'civil_status' => 'Single',
        'contact_number' => 9123456789,
        'quantity_family_members' => 5,
        'quantity_dependents' => 3,
        'quantity_working_dependents' => 1,
        'crop_name_planted' => 'Talong, Sigarilyas, Mani',
        'training_name_joined' => 'SAP',
        'highest_educational_status' => 'High School',
        'college_course' => 'N/A',
        'farming_years' => 3,
        'current_job' => 'Farmer',
        'affiliated_organization' => 'N/A',
        'salary_periodicity' => 'Every three months',
        'estimated_salary' => 40000,
        'social_status' => 'Poor',
        'social_status_reason' => 'None',
        'mode_of_application' => 'Manual'
    ]);
});

//view all farmers
Route::get('/view-all-farmer-profile', function () {
    $farmer_profile = farmer_profile::all();
    return view('test-view-profile')->with('farmer_profile', $farmer_profile);
});


//create a farmer in a profile (SHOW FORM)
Route::get('/create-farmer-profile', function () {
    return view('test-create-farmer-profile');
});


//create a farmer in a profile (PROCESS FORM)
Route::post('/process-farmer-profile', function () {
    $data = request()->all();
    $farmer_profile = farmer_profile::create($data);
    return redirect()->route('route-view-farmer-profile', ['farmer_profile' -> $farmer_profile]);
});


//view a single farmer profile
Route::get('/view-farmer-profile/{farmer_profile:lastname}', function ($lastname) {
    $farmer_profile = farmer_profile::where('lastname', $lastname)->firstorFail();
    return $farmer_profile;
})->name('route-view-farmer-profile');


//update a farmer profile (view the form)
//Route::get('/farmer_profile/{lastname}', function ($lastname) {});

//update a farmer profile (process the form)
//Route::patch('/farmer_profile/{profile:id}', function (farmer_profile $farmer_profile) {
    //$farmer_profile->fill(request()->all());
    //$farmer_profile->save();
    //return redirect()->route('profile', ['profile' -> $farmer_profile]);
//});

//delete a farmer profile
Route::delete('/farmer_profile/{profile:id}', function (farmer_profile $farmer_profile) {
    $farmer_profile->delete();
    return redirect()->route('farmer_profile');
});