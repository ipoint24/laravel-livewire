<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Order;

class Orders extends Component
{
    use WithPagination;

    public $confirming;
    public $customer_name;
    public $customer_email;
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

    public function updatedCustomerName()
    {
        $this->validate([
            'customer_name' => 'required|max:120|unique:orders,customer_name,' . $this->order_id
        ]);
    }

    public function updatedCustomerEmail()
    {
        $this->validate([
            'customer_email' => 'required|email|unique:orders,customer_email,' . $this->order_id
        ]);
    }

    public function store()
    {
        $validatedAttributes = $this->validate([
            'customer_name' => 'required|max:120|unique:orders,customer_name,' . $this->order_id,
            'customer_email' => 'required|email|unique:orders,customer_email,' . $this->order_id,
            //'created_at' => 'nullable|date',
        ]);
        /*
        $data = array(
            'customer_name' => $this->name,
            'customer_email' => $this->email,
        );
        $order = Order::updateOrCreate(['id' => $this->order_id], $data);
        */
        $order = Order::updateOrCreate(['id' => $this->order_id], $validatedAttributes);
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

    public function delete(Order $order)
    {
        $this->order_id = $order->id;
        $order->products()->detach();
        $order->delete();
        $this->emit('alert', ['type' => 'success', 'message' => 'Order deleted', 'title' => 'Deleting']);
    }
}
