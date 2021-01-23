<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class Orders extends Component
{
    use WithPagination;

    public $confirming;
    public $name;
    public $email;
    public $order_id;
    public $isOpen = 0;
    public $filter = [
        "name" => ""
    ];
    public $active;

    protected $listeners = [
        'orderSelected'
    ];

    public function orderSelected($orderId)
    {
        $this->active = $orderId;
        $this->emitTo('products', 'orderSelected', $orderId);
    }

    public function render()
    {
        $orders = $this->loadList();
        return view('livewire.orders.orders')
            ->with('orders', $orders)
            ->layout('layouts.default');
    }

    public function loadList()
    {
        $orders = Order::orderBy('id', 'desc');
        if (!empty($this->filter["name"])) {
            $orders = $orders->where('customer_name', 'LIKE', $this->filter['name'] . '%');
        }
        $orders = $orders->paginate(5);
        return $orders;
    }

    public function create()
    {
        $this->resetInputFields();
        $this->openModal();
    }

    private function resetInputFields()
    {
        $this->name = '';
        $this->email = '';
        $this->order_id = '';
    }

    public function openModal()
    {
        $this->isOpen = true;
        // Clean errors if were visible before
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function updatedName()
    {
        $this->validate([
            'name' => 'required|unique:orders,customer_name,' . $this->order_id
        ]);
    }

    public function updatedEmail()
    {
        $this->validate([
            'email' => 'required|email|unique:orders,customer_email,' . $this->order_id
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|unique:orders,customer_name,' . $this->order_id,
            'email' => 'required|email|unique:orders,customer_email,' . $this->order_id
        ]);
        $data = array(
            'customer_name' => $this->name,
            'customer_email' => $this->email,
        );
        $order = Order::updateOrCreate(['id' => $this->order_id], $data);
        $type = "success";
        $message = $this->order_id ? 'Order Updated Successfully.' : 'Order Created Successfully.';
        $this->emit('alert', ['type' => $type, 'message' => $message, 'title' => 'Title']);
        $this->closeModal();
        $this->resetInputFields();
    }

    public function closeModal()
    {
        $this->isOpen = false;
    }

    public function edit($id)
    {
        $order = Order::findOrFail($id);
        $this->order_id = $id;
        $this->name = $order->customer_name;
        $this->email = $order->customer_email;
        $this->openModal();
    }

    public function confirmDelete($id)
    {
        $this->confirming = $id;
    }

    public function delete($id)
    {
        $this->order_id = $id;
        $order = Order::find($id);
        $order->products()->delete();
        $order->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Order deleted', 'title' => 'Deleting']);
    }
}