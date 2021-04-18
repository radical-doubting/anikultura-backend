<?php

namespace App\Http\Livewire;

use App\Actions\Home\PrintHomeMessage;
use Livewire\Component;

class Home extends Component
{
    public function mount()
    {
        PrintHomeMessage::run('Hello, world!!!');
    }

    public function render()
    {
        return view('livewire.home');
    }
}
