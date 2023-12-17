<script>
    var Toast = Swal.mixin({
      toast: true,
      position: 'bottom-end',
      showConfirmButton: false,
      timer: 3000,
      html: '<span class="swal-toast-close-btn" onclick="dismissToast()"><i class="fa fa-times"></i></span>'
    });

    function dismissToast() {
        Swal.close();
    }

    @if(Session::has('message'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('message') }}"
        });
    @endif

    @if(Session::has('success'))
        Toast.fire({
            icon: 'success',
            title: "{{ session('success') }}"
        });
    @endif

    @if(Session::has('error'))
        Toast.fire({
            icon: 'error',
            title: "{{ session('error') }}"
        });
    @endif

    @if(Session::has('info'))
        Toast.fire({
            icon: 'info',
            title: "{{ session('info') }}"
        });
    @endif

    @if(Session::has('warning'))
        Toast.fire({
            icon: 'warning',
            title: "{{ session('warning') }}"
        });
    @endif
</script>
