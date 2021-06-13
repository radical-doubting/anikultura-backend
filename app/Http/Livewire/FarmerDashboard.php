<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\FarmerReport;

class FarmerDashboard extends Component
{
    public $user;
    public $farmer_profile;
    public $report;
    public $seed_stage;

    public function mount()
    {
        $user = Auth::user();

        $this->user = $user;
        $this->farmer_profile = $user->profile;

        $this->initialize_report();
    }

    public function initialize_report()
    {
        $this->report = $this->get_latest_report();
    }

    public function get_latest_report()
    {
        $latest_report = FarmerReport::where('farmer_id', $this->user->id)
            ->orderBy('created_at', 'desc')
            ->first();

        return $latest_report;
    }

    public function has_report()
    {
        return !is_null($this->report);
    }

    public function advance_stage()
    {
        $user_id = $this->user->id;
        $crop_id = $this->report->crop->id;
        $farmland_id = $this->report->farmland->id;
        $next_seed_stage_id = $this->report->seed_stage->id + 1;

        // If no more next stage, cancel advancing
        if ($next_seed_stage_id > 6)
            return;

        FarmerReport::create([
            'farmer_id' => $user_id,
            'seed_stage_id' => $next_seed_stage_id,
            'farmland_id' => $farmland_id,
            'crop_id' => $crop_id,
            'volume' => 50, // Will be inputted by farmer, yes?
        ]);

        // Reinitialize report to update UI
        $this->initialize_report();
    }

    public function render()
    {
        return view('livewire.farmer-dashboard');
    }
}
