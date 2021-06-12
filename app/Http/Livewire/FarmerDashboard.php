<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\FarmerReport;
use App\User;
use Illuminate\Support\Facades\DB;


class FarmerDashboard extends Component
{
    public $user_id, $report, $seed_stage, $seed_temp;

    public function mount(){
        $this->user_id = Auth::id();
        $this->report = FarmerReport::where('farmer_profiles_id', $this->user_id)
            ->orderBy('created_at', 'desc')
            ->first();

        $this->seed_stage = $this->report->seed_stage()->name;
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

        FarmerReport::create([
                'farmer_profiles_id' => $this->user_id,
                'seed_stages_id' => $this->stage,
                'farmland_id' => 1,
                'crop_id' => 1,
                'volume' => 50,
            ]);
        return view('livewire.farmer-dashboard');
    }
}
