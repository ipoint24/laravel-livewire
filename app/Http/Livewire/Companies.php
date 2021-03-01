<?php

namespace App\Http\Livewire;

use App\Models\Tenant;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;

class Companies extends Component
{
    use WithPagination;

    public $confirming;
    public $title;
    public $description;
    public $company_id;
    public $isOpen = 0;
    public $tenant_id = 0;
    public $selectedTenants = [];
    public $filter = [
        "title" => ""
    ];

    // Use in input wire:model="filter.title"

    public function mount()
    {
        $this->loadList();
    }

    public function loadList()
    {
        $companies = Company::orderBy('id', 'desc');
        if (!empty($this->filter["title"])) {
            $companies = $companies->where('title', 'LIKE', $this->filter['title'] . '%');
        }
        $companies = $companies->paginate(10);
        return $companies;
    }


    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->description = '';
        $this->company_id = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
        // Clean errors if were visible before
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedTitle()
    {
        $this->validate([
            'title' => 'required|unique:companies,title,' . $this->company_id
        ]);
    }

    public function updatedDescription()
    {
        $this->validate([
            'description' => 'required|min:10|max:200'
        ]);
    }

    public function store()
    {
        $validatedAttributes = $this->validate([
            'title' => 'required|unique:companies,title,' . $this->company_id,
            'description' => 'required|min:10|max:200'
        ]);

        $data = array(
            'title' => $this->title,
            'description' => $this->description,
            'tenant_id' => auth()->user()->tenant_id,
        );

        $company = Company::updateOrCreate(['id' => $this->company_id], $data);
        session()->flash('message', $this->company_id ? 'Company updated successfully.' : 'Company created successfully.');
        $this->closeModal();
        $this->resetInputFields();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $company = Company::findOrFail($id);
        $this->company_id = $id;
        $this->title = $company->title;
        $this->description = $company->description;
        $this->openModal();
    }

    public function cancelDelete($id)
    {
        $this->confirming = 0;
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function delete($id)
    {
        $this->company_id = $id;
        Company::find($id)->delete();
        session()->flash('message', 'Company deleted successfully.');
    }

    public function render()
    {
        $tenants = Tenant::all();
        $companies = $this->loadList();
        return view('livewire.companies.companies')
            ->with('companies', $companies)
            ->with('tenants', $tenants);
    }
}
