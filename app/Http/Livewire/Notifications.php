<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Notifications extends Component
{
    public $listeners = [
        "flash_message" => "flashMessage"
    ];


    public function flashMessage($type, $msg)
    {
        session()->flash($type, $msg);
    }

    public function render()
    {
        return view('livewire.notifications');
    }
}
