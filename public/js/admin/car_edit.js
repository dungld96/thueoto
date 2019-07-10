const BASE_URL = window.location.origin;
$(document).ready(function() {
    $('#btnAddCar').click(() => {
        $('#btnAddCar').attr('disabled', 'disabled');
        let valid = $('#carInfoForm').valid();
        let carInfo = $('#carInfoForm').serialize();
        let url = BASE_URL + '/admin/cars/store';
        console.log(carInfo);
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url,
                data: carInfo,
                success: function(data) {
                    if (data.status == 'success') {
                        $('#addCar').modal('hide');
                        var oTable = $('#carsdata').dataTable(); 
                        oTable.fnDraw(false);
                    }else{
                        alert(data.message);
                    }
                },
                error: function(e) {
                    alert(e);
                }

            });
        }
    })
    // Dropzone.autoDiscover = false;
    var uploadedDocumentMap = {}
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        maxFilesize: 12,
        maxFiles: 12,
        renameFile: function(file) {
            var dt = new Date();
            var time = dt.getTime();
            return time + file.name;
        },
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        previewTemplate: document.querySelector('#dz-preview-template').innerHTML,
        previewsContainer: "#template-preview",
        dictRemoveFile: "×",
        addRemoveLinks: true,
        timeout: 5000,
        thumbnailWidth: 80,
        thumbnailHeight: 60,
        // autoProcessQueue: false,
        dictMaxFilesExceeded: "Bạn chỉ được tải lên 12 file.",
        success: function(file, response) {
            $('#carInfoForm').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function(file) {
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }
            $('form').find('input[name="document[]"][value="' + name + '"]').remove()
        },
        error: function(file, response) {
            return false;
        }
    });

    $('#carInfoForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            name: {
                minlength: 2,
                required: true
            },
            code: {
                minlength: 2,
                required: true
            },
            car_manufacturer: {
                required: true
            },
            seats: {
                required: true,
                number: true
            },
        },
        messages: {
            name: {
                required: "Tên không được để trống",
                minlength: "Tên phải từ 2 ký tự trở lên",
            },
            code: {
                required: "Mã xe không được để trống",
                minlength: "Mã xe phải từ 2 ký tự trở lên",
            },
            car_manufacturer: {
                required: "Hãng xe không được để trống",
            },
            seats: {
                required: "Số ghế không được để trống",
                number: "Số ghế phải dạng chữ số",
            },
        },
        highlight: function(element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function(element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
    });

});