<div class="text-center mb-8">

    <h1 class="font-bold mb-3 mt-8">Mabuhay, {{ $user->first_name }}!</h1>

    @if($this->has_report() && $report->seed_stage->id < 8)
        <span class="text-sm font-medium bg-yellow-100 py-1 px-2 rounded text-yellow-500 align-middle">
            <b>Tanim:</b> {{ $report->crop->name }}
        </span>
        <img class="m-auto mt-3" src="/img/{{ $report->seed_stage->image }}" style="height: 250px;" />
        <div>
            <button class="bg-green-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full mt-8 md:my-8" style="margin-bottom: 10px;" 
            wire:click="advance_stage">
                {{ $report->seed_stage->name }}
            </button>
            <button type="button" class="pointer-events-none bg-red-500 disabled:opacity-50 m-auto text-white font-bold py-2 px-4 flex rounded-full" wire:click="advance_stage" disabled>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
                &nbsp;Ibahin ang araw ng naitala 
            </button>
        <div>
    @else
        <img class="m-auto" src="/img/{{ $report->seed_stage->image }}" style="height: 250px;" />
        <p>{{ $report->seed_stage->name }}</p>
    @endif

</div>