<div class="text-center mb-8">

    <h1 class="font-bold">Mabuhay, {{ $user->first_name }}!</h1>

    @if($this->has_report())
        <p>Uri ng tanim: {{ $report->crop->name }}</p>
        <img class="m-auto" src="/img/{{ $report->seed_stage->image }}" style="height: 250px;" />
        <div>
            <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-8 md:my-8" style="margin-bottom: 10px;" 
            wire:click="advance_stage">
                {{ $report->seed_stage->name }}
            </button>
            <button class="bg-red-500 hover:bg-blue-700 m-auto text-white font-bold py-2 px-4 flex rounded-full" wire:click="advance_stage">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                &nbsp;Ibahin ang araw ng naitala 
            </button>
        <div>
    @else
        Wala ka pang natatanggap na starter kit. Ipalam ito sa kinauukulan.
    @endif

</div>