$(document).ready(function () {
    if ($('#carMake').val()) {
        let makeCode = $('#carMake').val();
        appendModelOption(makeCode, $modelCode);
    }

    $('#btnAddCar').click(() => {
        $('#btnSaveCar').attr('disabled', 'disabled');
        let valid = $('#carInfoForm').valid();
        let carInfo = $('#carInfoForm').serialize();
        let url = BASE_URL + '/admin/cars/store';
        if (valid) {
            $.ajax({
                type: 'POST',
                url: url,
                data: carInfo,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#addCar').modal('hide');
                        var oTable = $('#carsdata').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (e) {
                    alert(e);
                }

            });
        }
    });

    $('#btnUpdateCar').click(() => {
        $('#btnUpdateCar').attr('disabled', 'disabled');
        let valid = $('#carInfoForm').valid();
        let carInfo = $('#carInfoForm').serialize();
        let url = BASE_URL + '/admin/cars/update';
        if (valid) {
            $.ajax({
                type: 'PUT',
                url: url,
                data: carInfo,
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success(data.message);
                        $('#addCar').modal('hide');
                        var oTable = $('#carsdata').dataTable();
                        oTable.fnDraw(false);
                    } else {
                        toastr.error(data.message);
                    }
                },
                error: function (e) {
                    alert(e);
                }

            });
        }
    });

    $('body').on('change', '#carMake', function (e) {
        let makeCode = this.value;
        if (makeCode) {
            appendModelOption(makeCode);
        } else {
            $('#carModel').attr('disabled', 'disabled');
            $('#carModel').html('');
            $('#carModel').append(`<option value="">Chọn hãng xe trước</option>`);
        }
    });

    
    $('body').on('change', '#file-car-spec', function (e) {

        if ($(this).val() != '') {
            let car_spec = this.files[0];
            var form_data = new FormData();
            form_data.append('file', car_spec);
            $.ajax({
                url: BASE_URL + '/admin/images/upload/store',
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    $('#car-spec').val(data.name);
                    $('.preview-car-spec img').attr('src', BASE_URL + '/uploads/' + data.name);
                    $('#remove-car-spec').show();
                },
                error: function (e) {
                    console.log(e)
                   
                }
            });
        }
    });

    $('#remove-car-spec').on('click', function (e) {
        $('#car-spec').val('');
        $('#file-car-spec').val('');
        $('.preview-car-spec img').attr('src', '');
        $('#remove-car-spec').hide();

    });

    $('#btn-car-spec').on('click', function (e) {
        $('#file-car-spec').click();
    });

    


    // Dropzone.autoDiscover = false;
    var uploadedDocumentMap = {}
    Dropzone.autoDiscover = false;
    var myDropzone = new Dropzone("#dropzone", {
        maxFilesize: 12,
        maxFiles: 12,
        renameFile: function (file) {
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
        init: function () {
            if (typeof $images !== 'undefined') {
                $images.forEach(img => {
                    let mockFile = { file_name: img.name, size: img.size }; // here we get the file name and size as response 
                    this.options.addedfile.call(this, mockFile);
                    this.emit("complete", mockFile);
                    this.options.thumbnail.call(this, mockFile, BASE_URL + "/uploads/" + img.name);
                    $('#carInfoForm').append('<input type="hidden" name="document[]" value="' + img.name + '">')
                });
            }
        },
        success: function (file, response) {
            $('#carInfoForm').append('<input type="hidden" name="document[]" value="' + response.name + '">')
            uploadedDocumentMap[file.name] = response.name
        },
        removedfile: function (file) {
            console.log(file);
            file.previewElement.remove()
            var name = ''
            if (typeof file.file_name !== 'undefined') {
                name = file.file_name
            } else {
                name = uploadedDocumentMap[file.name]
            }

            let url = BASE_URL + '/admin/images/remove/' + name;
            let token = $('meta[name="_token"]').attr('content');
            let isStored = false;
            if (typeof $images !== 'undefined') {
                $images.forEach(img => {
                    if (name == img.name) {
                        isStored = true;
                    }
                });
            }
            if (typeof $carId == 'undefined' || !isStored) {
                console.log('img no store');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: {
                        "name": name,
                        "_token": token,
                    },
                    success: function (data) {
                        if (data.status == 'success') {
                            $('form').find('input[name="document[]"][value="' + name + '"]').remove();
                        } else {
                            console.log(data.message);
                        }
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
            } else {
                console.log('store');

                $('form').find('input[name="document[]"][value="' + name + '"]').remove();
            }

        },
        error: function (file, response) {
            return false;
        }
    });

    $('#carInfoForm').validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-block help-block-error', // default input error message class
        focusInvalid: true, // do not focus the last invalid input
        rules: {
            number_plate: {
                minlength: 2,
                required: true
            },
            code: {
                minlength: 2,
                required: true
            },
            make_code: {
                required: true
            },
            model_code: {
                required: true
            },
            car_year: {
                required: true
            },
            seats: {
                required: true,
                number: true
            },
            costs: {
                required: true,
                number: true
            },
        },
        messages: {
            number_plate: {
                required: "Biển số không được để trống",
                minlength: "Biển phải từ 2 ký tự trở lên",
            },
            code: {
                required: "Mã xe không được để trống",
                minlength: "Mã xe phải từ 2 ký tự trở lên",
            },
            make_code: {
                required: "Hãng xe không được để trống",
            },
            model_code: {
                required: "Mẫu xe không được để trống",
            },
            car_year: {
                required: "Năm sản xuất không được để trống",
            },
            seats: {
                required: "Số ghế không được để trống",
                number: "Số ghế phải dạng chữ số",
            },
            costs: {
                required: "Số tiền không được để trống",
                number: "Số tiền phải dạng chữ số",
            },
        },
        highlight: function (element) { // hightlight error inputs
            $(element)
                .closest('.form-group').addClass('has-error'); // set error class to the control group
        },

        unhighlight: function (element) { // revert the change done by hightlight
            $(element)
                .closest('.form-group').removeClass('has-error'); // set error class to the control group
        },
    });

});

function appendModelOption(makeCode, modelCode = null) {
    url = BASE_URL + '/getModels/' + makeCode;
    $.ajax({
        type: 'GET',
        url: url,
        success: function (rs) {
            if (rs.status == 'success') {
                $('#carModel').removeAttr('disabled');
                $('#carModel').html('');
                $('#carModel').append(`<option value="">Chọn mẫu xe</option>`);
                rs.modelByMakes.forEach(model => {
                    $('#carModel').append(`<option ${modelCode == model.code ? 'selected' : ''} value="${model.code}">${model.name}</option>`);
                }); 
            } else {
                console.log(rs.message);
            }
        },
        error: function (e) {
            alert(e);
        }

    });
}