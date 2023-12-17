<script>
    // For Modal Data Save (Store/Update)
    function modalSave(route, resetFalse = false){
        $('.c-preloader').fadeIn();
        $.ajax({
            url: route,
            type: "POST",
            data: $('#dataForm').serialize(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            $('.input-error-message').remove();
            $('.c-preloader').fadeOut();
            if(data.success == 0){
                Swal.fire('Warning!', 'Something Went Wrong, please reload the page and try again.', 'warning');
                $('.c-preloader').fadeOut();
            }else{
                $('.prev-generated-url-wrap').slideDown();
                $('.prev-generated-url-wrap .generated-url').val(`{{getBaseURL()}}${data.generated_url}`);
                $('.prev-generated-url-wrap .copy-data-text-btn').attr('data-text',`{{getBaseURL()}}${data.generated_url}`);

                if(resetFalse != 'resetFalse'){
                    resetDataForm();
                }
                
                if($('#modalDataForm .close').length > 0){
                    $('#modalDataForm .close')[0].click();
                }

                if($('.data-table').length > 0){
                    $('.data-table').DataTable().ajax.reload();
                }
                
                Toast.fire({icon: 'success',title: 'Data Saved Successfully!'})
            }
        }).fail(function(xhr, status, error) {
            if(xhr.status == 422){
                $('.input-error-message').remove();
                var errors = JSON.parse(xhr.responseText);
                $.each(errors.errors, function(field, messages) {
                    $(`#dataForm [name="${field}"]`).closest('.form-control-wrap').append(`<span class="input-error-message text-danger text-capitalize">${messages[0]}</span>`);
                });
            }else{
                alert(xhr.responseText);
            }
            $('.c-preloader').fadeOut();
        });
    }

    // For Data Edit Modal
    function loadModal(route, dataId){
        $('.c-preloader').fadeIn();
        $.ajax({
            url: route,
            type: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        }).done(function(data) {
            if(data.success === 1){
                $('#modalDataForm').modal('show');
                var info = data.data;
                $(`#dataForm [name="slug"]`).val(info.slug);
                $(`#dataForm [name="user_id"]`).val(info.user_id).trigger("change");
                $(`#dataForm [name="original_url"]`).val(info.original_url);

                $('.generated-url-wrap').slideDown();
                $(`#dataForm [name="generated_url"]`).val(info.generated_url);
            }
            $('.c-preloader').fadeOut();
        }).fail(function(xhr, status, error) {
            alert(xhr.responseText);
            $('.c-preloader').fadeOut();
        });
    }

    // For Force Close Modal If Default Close Not Work
    $(document).on('click', '#modalDataForm .close', function(){
        $(this).closest('#modalDataForm').modal('hide');
    });

    // For Reset Form On Creating/Updating Modal Show/Hide
    $(".modal").on("hidden.bs.modal", function () {
        resetDataForm();
    });

    // For Reset Form
    resetDataForm();
    function resetDataForm(){
        if($('#dataForm').length > 0){
            $('.input-error-message').remove();

            $('#dataForm')[0].reset();
            $('#dataForm').find('.data_slug').val('');
            if($('#dataForm').find('.select2').length > 0){
                $('#dataForm').find('.select2').prop('selectedIndex', 0).trigger("change");
            }
            $('.generated-url-wrap').slideUp();
        }
        
    }

    // For Delete Data 
    $(document).on('click', '.delete-data-btn', function(e) {
        e.preventDefault();
        let delete_url = $(this).attr('delete-url');
        Swal.fire({
            title: 'Are you sure?',
            text: "You wont be able to revert this deletion!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel'
        }).then((result) => {
            if (result.isConfirmed) {
                var btn = this;
                $('.c-preloader').fadeIn();
                $.ajax({
                    url: delete_url,
                    type: "GET",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                }).done(function(data) {
                    $('.c-preloader').fadeOut();
                    if(data.success == 0){
                        Swal.fire('Warning!', 'Something Went Wrong, please reload the page and try again.', 'warning');
                        $('.c-preloader').fadeOut();
                    }else{
                        $('.data-table').DataTable().ajax.reload();
                        Toast.fire({icon: 'success',title: 'Data Deleted Successfully!'})
                    }
                }).fail(function(xhr, status, error) {
                    alert(xhr.responseText);
                    $('.c-preloader').fadeOut();
                }); 
            }
        })
    });
</script>