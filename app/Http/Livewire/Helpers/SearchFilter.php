<?php

namespace App\Http\Livewire\Helpers;

use Livewire\Component;
use Log;

class SearchFilter extends Component
{
    public $searchTerm = '';
    public $options = [];
    public $highlightIndex = 0;
    public $model = '';
    public $listenerName = '';
    public $searchField = '';

    public function mount()
    {
        $this->resetValues();
    }

    public function resetValues()
    {
        $this->searchTerm = '';
        $this->options = [];
        $this->highlightIndex = 0;
    }

    public function render()
    {
        return view('livewire.helpers.search-filter');
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex === count($this->options) - 1) {
            $this->highlightIndex = 0;
            return;
        }
        $this->highlightIndex++;
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->options) - 1;
            return;
        }
        $this->highlightIndex--;
    }

    public function selectOption()
    {
        $option = $this->options[$this->highlightIndex] ?? null;
        if ($option) {
            // $this->redirect(route('show-contact', $contact['id']));
            // Emit to listener id
            // aus Blade  wire:click="$emit('orderSelected',{{$order->id}})"
            $this->emit('alert', ['type' => "success", 'message' => "Option:" . $option, 'title' => 'Title']);
        }
    }

    public function updatedSearchTerm()
    {
        Log::info("SearchTerm updated");
        $this->options = $this->model::where($this->searchField, 'like', '%' . $this->searchTerm . '%')
            ->get();
    }
}
