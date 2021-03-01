<div>
    <button wire:click="create()"
            class="bg-indigo-400 hover:bg-indigo-700 text-gray-200 py-1 px-3 rounded my-3">
        Create New Order
    </button>
    @if($isOpen)
        @include('livewire.orders.form_order')
    @endif
    <table class="table-auto w-full text-left">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 w-20 border">No.</th>
            <th class="px-4 py-2 border">Customer</th>
            <th class="px-4 py-2 border">E-Mail</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
        @foreach($orders as $order)
            <tr class="rounded border shadow p-3 my-2 {{$active == $order->id ? 'bg-gray-400':''}}"
                wire:click="$emit('orderSelected',{{$order->id}})">
                <td class="border px-4 py-2">{{ $order->id }}</td>
                <td class="border px-4 py-2">{{ $order->customer_name }}</td>
                <td class="border px-4 py-2">{{ $order->customer_email }}</td>
                <td class="border px-4 py-2">
                    <div class="inline-block whitespace-no-wrap">
                        <button wire:click="edit({{ $order->id }})"
                                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Edit
                        </button>
                        @if($confirming===$order->id)
                            <button wire:click="delete({{ $order->id  }})"
                                    class="bg-red-800 text-white w-32 px-4 py-1 hover:bg-red-600 rounded border">
                                Sure?
                            </button>
                        @else
                            <button
                                wire:click="confirmDelete({{ $order->id }})"
                                class="bg-gray-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                Delete
                            </button>
                        @endif
                    </div>
                </td>
            </tr>
        @endforeach

        </tbody>
    </table>
    <div>
        {{ $orders->links('components.section.pagination',['is_livewire' => true]) }}
    </div>

</div>

