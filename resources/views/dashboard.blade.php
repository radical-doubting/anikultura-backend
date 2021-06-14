<head>
@livewireStyles
<link rel="stylesheet" href="//use.​fontawesome.com/releases/v5.0.7/css/all.css">
    <title>Farmer Dashboard</title> 
</head>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Farmer Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <livewire:farmer-dashboard/>
            </div>
        </div>
    </div>
    @livewireScripts
</x-app-layout>
