<div>
    Select with Alpine:<br>
    <x-input.selectalp3/>
    <br>
    <hr>
    @if($orderId>0)
        @if($activeProduct > 0)
        <button wire:click="addProduct()"
                class="bg-indigo-400 hover:bg-indigo-700 text-gray-200 py-1 px-3 rounded my-3">
            + Add Product
        </button>
        @endif
        SelectedProducts: {{count($selectedProducts)}}
        <select wire:model="activeProduct">
            <option value="">-- choose product --</option>
            @foreach ($allProducts as $product)
                <option value="{{ $product->id }}">
                    {{ $product->name }} (${{ number_format($product->price, 2) }})
                </option>
            @endforeach
        </select>
        Active Product : {{$activeProduct }}
    @endif
    <table class="table-auto w-full text-left" id="products_table">
        <thead>
        <tr class="bg-gray-100">
            <th class="px-4 py-2 border">Product</th>
            <th class="px-4 py-2 border">Price</th>
            <th class="px-4 py-2 border">Quantity</th>
            <th class="px-4 py-2 border">Sum</th>
            <th class="px-4 py-2 border">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($products as $prod)
            <tr>
                <td>{{$prod->name}} (Index: {{$loop->index}}, Produkt: {{$prod->id}}</td>
                <td>{{ number_format($prod->price, 2) }}</td>
                <td>
                    @if($prod->id == $rowToEdit)
                        <div class="flex">
                            <input class="w-20 bg-gray-400" wire:model="quantity.{{$prod->id}}" type="text">

                            <button
                                wire:click="saveQuantity({{$prod->id}})"
                                class="bg-gray-300 text-green-800"><i class="fas fa-check"></i></button>
                        </div>
                        @error('quantity.*') <span class="text-sm text-red-500">{{ $message }}</span>@enderror
                    @else
                        <div class="flex">
                            {{$prod->pivot->quantity}}
                            <button
                                wire:click="editRow({{$prod->id}})"
                                class="bg-gray-300 text-green-800"><i class="fas fa-edit"></i></button>
                        </div>

                    @endif
                </td>
                <td>
                    {{$prod->pivot->quantity * $prod->price}}
                </td>
                <td>
                    <button wire:click="removeProduct({{$prod->id}})"
                            class="bg-red-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Remove
                    </button>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

</div>
