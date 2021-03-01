<?php

namespace App\Http\Livewire\Acl;

use Livewire\Component;

class Acl extends Component
{
    public function render()
    {
        return view('livewire.acl.acl')
            ->layout('layouts.default');
    }
}
