$(document).ready(function(){
    function showErr(currentInput, msg) {
        currentInput.parent().append('<p class="err mt-2 text-danger">');
        currentInput.parent().find('p.err').text(msg);
    }
    
    function clientIsValid() {
        var err = [];
        $('.form-add :input').each(function(){
            var msg = '';
    
            // Catch err if input fields are not submit button
            if($(this).attr('name') !== 'submit' && $(this).attr('name') !== 'dob_holder') {
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
    
    $('#dob_holder').datepicker({
        dateFormat: 'dd/mm/yy',
        altFormat: 'yy-mm-dd',
        altField:  '#dob',
        maxDate: '0',
        defaultDate: '0'
    });
    
    $('#btn-add').click(function() {
        $('html').css('overflow','hidden');
        $('#overlay-bg').addClass('show');
        $('.form-add').addClass('show');
    });
    
    $('.table tbody tr').click(function(){
        $('html').css('overflow','hidden');
        $('#overlay-bg').addClass('show');
        $('.popup-user').addClass('show');
    })
    
    $('#overlay-bg').click(function() {
        $('html').css('overflow','auto');
        $('#overlay-bg').removeClass('show');
        $('.popup-user').removeClass('show');
        $('.form-add').removeClass('show');
        $('.success').removeClass('show');
        $('p.err').remove();
    });
    
    $('#submit').click(function(event){
        event.preventDefault();
        
        $('#overlay-bg').addClass('show');
        $('.form-add').addClass('show');
        $('p.err').remove();
        
        // Client-side validate
        // clientIsValid()
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
                    if(jsonData.type === 'ok') {
                        console.log('Thành công');
    
                        $('html').css('overflow','auto');
                        $('.form-add').trigger('reset');
                        $('.form-add').removeClass('show');
                        $('.success').addClass('show');
                    } else {
                        if(jsonData.message === 'validate error') {
                            console.log('CI validate err');
                            $(".form-add").animate({ scrollTop: 0 }, "slow");
                            $.each(jsonData.validate, function(key, value) {
                                $('.form-add :input').each(function(){
                                    if($(this).attr('name') === key && value !== '') {
                                        showErr($(this), value);
                                    }
                                });
                            });
                        } else {
                            console.log('add err');
                            $(".form-add").animate({ scrollTop: 0 }, "slow");
                        }
                    }
                }
            })
        }
    })
});
