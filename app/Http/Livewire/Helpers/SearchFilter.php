<?php

namespace App\Http\Livewire\Helpers;

use Livewire\Component;
use Log;

class SearchFilter extends Component
{
    public $query; // Searchterm
    public $options = [];
    public $highlightIndex;
    public $model;
    public $listenerName;
    public $searchField = '';

    public function mount()
    {
        $this->resetValues();
    }

    public function resetValues()
    {
        $this->query = '';
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
            $this->emit('alert', ['type' => "success", 'message' => "Option:" . $option, 'title' => 'Title']);
        }
    }

    public function updatedQuery()
    {
        Log::info($this->model);
        $this->options = $this->model::where($this->searchField, 'like', '%' . $this->query . '%')
            ->get();
    }
}
