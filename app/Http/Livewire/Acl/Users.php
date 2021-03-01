<?php

namespace App\Http\Livewire\Acl;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use Spatie\Permission\Models\Role;
use DB;
use Hash;

class Users extends Component
{
    use WithPagination;

    public $name, $email, $password, $user_id;
    public $roles = [];
    public $isOpen = 0;
    public $active;
    public $confirming;
    public $modalTitle = '';
    public $originalId = 0;

    public function render()
    {
        $users = $this->loadList();
        return view('livewire.acl.users', [
            'users' => $users
        ]);
    }

    public function loadList()
    {
        $users = User::paginate(5);
        $this->roles = Role::pluck('name', 'name')->all();
        return $users;
    }

    public function updatedName()
    {
        $this->validate([
            'name' => 'required|unique:users,name,' . $this->user_id
        ]);
    }

    public function impersonate($userId)
    {
        $this->originalId = auth()->user()->id;
        session()->put('impersonate', $this->originalId);
        auth()->loginUsingId($userId);
        return redirect('acl');
    }

    public function updatedEmail()
    {
        $this->validate([
            'email' => 'required|email|unique:users,email,' . $this->user_id
        ]);
    }

    public function create()
    {
        $this->modalTitle = 'User erstellen';
        $this->resetInputFields();
        $this->openModal();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->user_id = '';
        $this->confirming = 0;
    }

    public function openModal()
    {
        $this->isOpen = true;
        // Clean errors if were visible before
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function edit($id)
    {
        $this->modalTitle = 'User bearbeiten';
        $user = User::findOrFail($id);
        $this->user_id = $id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->openModal();
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:users,name,' . $this->user_id,
            'email' => 'required|email|unique:users,email,' . $this->user_id,
        ]);
        $data = array(
            'name' => $this->name,
            'email' => $this->email,
        );
        $user = User::updateOrCreate(['id' => $this->user_id], $data);
        $this->emit('alert', ['type' => 'success', 'message' => 'User updated', 'title' => 'UpdateCreate']);
        $this->closeModal();
        $this->resetInputFields();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function delete($id)
    {
        $this->user_id = $id;
        //User::find($id)->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'User deleted', 'title' => 'Deleting']);
        $this->confirming = 0;
    }

}
