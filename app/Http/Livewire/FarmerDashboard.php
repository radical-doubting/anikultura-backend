<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\farmer_reports;
use App\User;
use Illuminate\Support\Facades\DB;


class FarmerDashboard extends Component
{
    public $user_id, $reports, $stage, $seed_temp;
    public $test = 69;

    public function mount(){
        $this->user_id = Auth::id();
        $this->reports = farmer_reports::where('farmer_profiles_id', $this->user_id)
            ->orderBy('created_at', 'asc')
            ->take(1)
            ->get();
        //  
        // $this->seed_temp = farmer_reports::where('farmer_profiles_id', $this->user_id)
        //     ->orderBy('created_at', 'asc')
        //     ->take(1)
        //     ->value('seed_stages_id');
    }

    public function render()
    {
        return view('livewire.farmer-dashboard');
    }

    public function advance_stage($uid, $stage_num)
    {
        $this->user_id = $uid;
        $this->stage = $stage_num;
        $this->stage++;
        farmer_reports::create([
                'farmer_profiles_id' => $this->user_id,
                'seed_stages_id' => $this->stage,
                'farmland_id' => 1,
                'crop_id' => 3,
                'volume' => 50,
            ]);
        return view('livewire.farmer-dashboard');
    }
}
