<!-- script -->
@livewireScripts
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

@stack('modals')
@yield('scripts')
@stack('scripts')

<script src="{{url('js/output.js')}}"></script>
<script src="{{url('js/custom.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    // Toastr Options
    toastr.options = {
        "positionClass": "toast-top-right",
        "closeButton": true,
        "debug": false,
        "newestOnTop": true,
        "progressBar": true,
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $(document).ready(function () {
        // Notifications
        window.livewire.on('alert', param => {
            toastr[param['type']](param['message'], param['title']);
        });
    });
</script>
<!-- end script -->



