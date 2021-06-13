<div class="text-center mb-8">

    <h1 class="font-bold">Hi, {{ $user->first_name }}</h1>

    <img src="https://cdn.discordapp.com/attachments/719478925700497842/850287856294297610/farr.png" style="height: 250px; margin: auto auto" />


    @if($this->has_report())
        <p>Stage image: {{ $report->seed_stage->image }}</p>
        <p>Crop: {{ $report->crop->name }}</p>
        <p>Seed stage: {{ $report->seed_stage->name }}</p>
        <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-8 md:my-8" wire:click="advance_stage">
            text here
        </button>
        <button class="bg-red-500 hover:bg-blue-700 text-white font-bold rounded-full py-2 self-center px-4 items-center">
            icon here
        </button>
    @else
        Wala ka pang natatanggap na starter kit.
    @endif

</div>