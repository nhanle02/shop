$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function removeRow(id, url) {
    if (confirm('Are you sure you want to remove?')) {
        $.ajax({
            type: 'DELETE',
            datatype: 'JSON',
            data: { id },
            url: url,
            success: function (result) {
                if (result.error === false) {
                    alert(result.message);
                    location.reload();
                } else {
                    alert('Remove failed! Please try again');
                }
             }
        })
    }
};



$('#upload').change(function () {
    const form  = new FormData();

    form.append('file', $(this)[0].files[0]);
    $.ajax({
        processData: false,
        contentType: false,
        type: 'POST',
        datatype: 'JSON',
        data: form,
        url: '/admin/upload/service',
        success: function(result) {
            if (result.error === false) {
                $('#image_show').html('<a href="'+ result.url +'" target="_blank">'
                + '<img src="'+ result.url +'" width="100px" /></a>')

                $('#file').val(result.url)
            } else {
                alert('upload failed')
            }
        }
    });
});

$('.upload-file').change(function(){
    const file = this.files[0];
    if (file){
        let reader = new FileReader();
        reader.onload = function(event){
            $('.image-show').html(`<img src="${event.target.result}" />`);
        }
        reader.readAsDataURL(file);
    }
});

$(document).on('click', '.js-show-form-delete', function () {
    let action = $(this).attr('data-action'),
        $modal = $('#modal-delete');
    $modal.find('form').attr('action', action)
    $modal.modal('show');
})
