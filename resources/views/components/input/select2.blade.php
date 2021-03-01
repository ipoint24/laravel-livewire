<div wire:ignore class="w-full">
    <select class="form-select select2" data-placeholder="{{__('Select your option')}}" {{ $attributes }}>
        <option></option>
        @foreach($options as $key => $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
        @endforeach
    </select>
</div>

@push('scripts')
    <script>
        $(document).ready(function () {
            $('.select2').select2({
                placeholder: '{{__('Select your option')}}',
                allowClear: true
            });
            $('.select2').on('change', function (e) {
                let elementName = $(this).attr('id');
                var data = $(this).select2("val");
            @this.set(elementName, data);
            });
            document.addEventListener("livewire:load", function (event) {
                window.livewire.hook('afterDomUpdate', () => {
                    $('.select2').select2();
                });
            });
        });
    </script>
@endpush