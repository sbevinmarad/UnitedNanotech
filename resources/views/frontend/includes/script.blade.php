<script type="text/javascript">

  
    toastr.options = {
      "closeButton": false,
      "debug": false,
      "newestOnTop": false,
      "progressBar": true,
    //   "positionClass": "toast-bottom-center",
      "preventDuplicates": false,
      "onclick": null,
     "showDuration": "300",
     "hideDuration": "1000",
      "timeOut": "9000",
     "extendedTimeOut": "1000",
      "showEasing": "swing",
      "hideEasing": "linear",
      "showMethod": "fadeIn",
      "hideMethod": "fadeOut"
    }

    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}");
    @endif


    @if(Session::has('info'))
        toastr.info("{{ Session::get('info') }}");
    @endif


    @if(Session::has('warning'))
        toastr.warning("{{ Session::get('warning') }}");
    @endif


    @if(Session::has('error'))
        toastr.error("{{ Session::get('error') }}");
    @endif

    window.addEventListener('modal-open', event  => {
            $('#delete_confirm_modal').modal('show');
    });

    
    window.addEventListener('toastr', event  => {
            alertMsg(event.detail.msg,event.detail.type);
    });

    function alertMsg($msg,$type){
        switch($type){
            case 'success':
                toastr.success($msg);
                break;
            case 'info':
                toastr.info($msg);
                break;
            case 'warning':
                toastr.warning($msg);
                break;
            case 'error':
                toastr.error($msg);
                break;
        }
    }

    const SwalModal = (icon, title, html) => {
        Swal.fire({
            icon,
            title,
            html
        })
    }

    const SwalConfirm = (icon, title, html, confirmButtonText, method, params, callback) => {
        Swal.fire({
            icon,
            title,
            html,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText,
            reverseButtons: true,
        }).then(result => {
            if (result.value) {
                return livewire.emit(method, params)
            }

            if (callback) {
                return livewire.emit(callback)
            }
        })
    }

    document.addEventListener('DOMContentLoaded', () => { 
        this.livewire.on('swal:modal', data => {
                SwalModal(data.type, data.title, data.text)
        })

        this.livewire.on('swal:confirm', data => {
            SwalConfirm(data.type, data.title, data.text, data.confirmText, data.method, data.params, data.callback)
        })

    })

function number_check(evt) {
        var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
    }

    

</script>