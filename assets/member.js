function showErr(currentInput, msg) {
    currentInput.parent().append('<p class="err mt-2 text-danger">');
    currentInput.parent().find('p.err').text(msg);
}

function clientIsValid() {
    var err = [];
    $('.form-add :input').each(function(){
        var msg = '';

        // Catch err if input fields are not submit button
        if($(this).attr('name') !== 'submit') {
            if($(this).val() === ''){
                // Empty field
                msg = 'Trường này không được bỏ trống';
            } else {
                // Email specific
                if($(this).attr('name') === 'email'){
                    var pattern = new RegExp(/\S+@\S+\.\S+/);
                    if(!pattern.test($(this).val())) {
                        msg = 'Email không hợp lệ';
                    }
                }
                // Phone specific
                if($(this).attr('name') === 'phone'){
                    if(!$.isNumeric($(this).val())){
                        msg = 'Chỉ nhận dữ liệu kiểu số';
                    } else if($(this).val().length < 10){
                        msg = 'Số điện thoải phải có 10 chữ số';
                    }
                }
            }
            // Show err if msg not empty
            if(msg !== '') {
                showErr($(this), msg);
                err.push(msg);
            }
        }
    })
    if(err.length === 0) {
        return true;
    }
    return false;
}

function formData() {
    var formData = new FormData();
    $('.form-add :input').each(function(){
        if($(this).attr('type') !== 'file') {
            if($(this).attr('name') === 'bio') {
                if($(this).prop('checked')) {
                    formData.append($(this).attr('name'), $(this).val());
                }
            } else {
                formData.append($(this).attr('name'), $(this).val());
            }
        } else {
            formData.append($(this).attr('name'), $(this).prop('files')[0]);
        }
    })
    return formData;
}

$('#dob').datepicker({
    todayHighlight: true,
    autoclose: true,
    endDate: new Date()
});

$('#btn-add').click(function() {
    $('html').css('overflow','hidden');
    $('#overlay-bg').addClass('show');
    $('.form-add').addClass('show');
});

$('#overlay-bg').click(function() {
    $('html').css('overflow','auto');
    $('#overlay-bg').removeClass('show');
    $('.form-add').removeClass('show');
    $('.success').removeClass('show');
});

$('#submit').click(function(event){
    event.preventDefault();
    
    $('#overlay-bg').addClass('show');
    $('.form-add').addClass('show');
    $('p.err').remove();
    
    // Client-side validate
    if(clientIsValid()) {
        $.ajax({
            url:  'http://localhost/SinhVienAPS/index.php/student/create',
            type: 'POST',
            data: formData(),
            processData: false,
            contentType: false,
            success: function(data)
            {
                var jsonData = JSON.parse(data);
                switch(jsonData.status) {
                    case 'ok':
                        console.log('Thành công');

                        $('html').css('overflow','auto');
                        $('.form-add').trigger('reset');
                        $('.form-add').removeClass('show');
                        $('.success').addClass('show');
                        break;
                    case 'valid_error':
                        console.log('CI validate err');
                        $(".form-add").animate({ scrollTop: 0 }, "slow");
                        $.each(jsonData.track_err, function(key, value) {
                            $('.form-add :input').each(function(){
                                if($(this).attr('name') === key && value !== '') {
                                    showErr($(this), value);
                                }
                            });
                        });
                        break;
                    case 'add_error':
                        console.log('Add err');
                        $(".form-add").animate({ scrollTop: 0 }, "slow");
                        break;
                }
            }
        })
    }
})