<script src="{{asset('backend/')}}/js/bundle.js?v={{time()}}"></script>
<script src="{{asset('backend/')}}/js/scripts.js?v={{time()}}"></script>
<script src="{{asset('backend/')}}/js/charts/chart-ecommerce.js?v={{time()}}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap5.min.js"></script>

<!-- Sweetalert2 -->
<script src="{{asset('backend')}}/plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- Select2 -->
<script src="{{asset('backend')}}/plugins/select2/js/select2.min.js"></script>
<!-- Toastr -->
<script src="{{asset('backend')}}/plugins/toastr/toastr.min.js"></script>
<!-- Input Mask -->
<script src="{{asset('backend')}}/plugins/moment/moment.min.js"></script>
<script src="{{asset('backend')}}/plugins/inputmask/inputmask.min.js"></script>
<!-- Daterangepicker -->
<script src="{{asset('backend')}}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Flatpicker -->
<script src="{{asset('backend')}}/plugins/flatpicker/npm_flatpickr.js"></script>
<!-- Tempusdominus -->
<script src="{{asset('backend')}}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{asset('backend')}}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- Ckeditor -->
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.2/super-build/ckeditor.js"></script>
{{-- <script src="https://cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script> --}}

<!-- Switch -->
<script src="{{asset('backend')}}/js/bootstrap-switch.min.js"></script>

<!-- Custom -->
<script src="{{asset('backend/')}}/js/custom.js?v={{time()}}"></script>

<script type="text/javascript">
	$(document).on('click', '.copy-data-text-btn', function(){
        var text = $(this).attr('data-text');

        var tempInput = $("<input>");
        $("body").append(tempInput);
        tempInput.val(text).select();
        document.execCommand("copy");
        tempInput.remove();

        Toast.fire({
            icon: 'success',
            title: `Text copied "${text}"`
        });
    });
</script>