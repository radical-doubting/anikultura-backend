<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\FarmerReport;
use App\Models\SeedStage;
use App\User;
use Illuminate\Support\Facades\DB;


class FarmerDashboard extends Component
{
    public $user_id, $report, $seed_stage, $seed_temp;

    public function mount()
    {
        $user = Auth::user();

        $this->user = $user;
        $this->profile = $user->profile;

        $this->report = $this->get_latest_report();
        $this->seed_stage = $this->get_seed_stage();
    }

    public function get_latest_report()
    {
        $latest_report = FarmerReport::where('farmer_profile_id', $this->user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $latest_report;
    }

    public function get_seed_stage()
    {
        $report = $this->report;
        $has_report = !is_null($report);
        $seed_stage = null;

        if ($has_report) {
            $seed_stage = $report->seed_stage->name;
            return $seed_stage;
        }

        // Get first seed stage
        return SeedStage::find(1);
    }

    public function advance_stage()
    {
        $user_id = $this->user->id;
        $this->stage = $stage_num;
        $this->stage++;

        FarmerReport::create([
            'farmer_profiles_id' => $this->user_id,
            'seed_stages_id' => $this->stage,
            'farmland_id' => 1,
            'crop_id' => 1,
            'volume' => 50,
        ]);
    }


    public function render()
    {
        return view('livewire.farmer-dashboard');
    }
}
