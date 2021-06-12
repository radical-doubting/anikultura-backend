<div class="text-center mb-8">
    <img src="https://cdn.discordapp.com/attachments/719478925700497842/850287856294297610/farr.png" style="height: 250px; margin: auto auto" />
        crop id: {{ $report->crop_id }}
        seed stages: {{ $report->seed_stages_id}}
        {{ $seed_stage->name }}
        <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-8 md:my-8" 
            wire:click="advance_stage({{ $report->farmer_profiles_id }}, {{ $report->seed_stages_id }})">
            text here
        </button>
        <button class="bg-red-500 hover:bg-blue-700 text-white font-bold rounded-full py-2 self-center px-4 items-center">
            icon here
        </button>

</div>
