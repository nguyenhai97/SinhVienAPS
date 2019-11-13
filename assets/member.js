$(document).ready(function(){
    var currentUser = {}

    function showErr(currentInput, msg) {
        currentInput.parent().append('<p class="err mt-2 text-danger">');
        currentInput.parent().find('p.err').text(msg);
    }
    
    function clientIsValid() {
        var err = [];
        var msg ='';

        if($('.form-add #name').val() === '') {
            msg = 'Trường này không được để trống';
            err.push({"key": "name", "value": msg});
        }

        if($('.form-add #address').val() === '') {
            msg = 'Trường này không được để trống';
            err.push({"key": "address", "value": msg});
        }

        if($('.form-add #course').val() === '') {
            msg = 'Trường này không được để trống';
            err.push({"key": "course", "value": msg});
        }

        if($('.form-add #dob_holder').val() === '') {
            msg = 'Trường này không được để trống';
            err.push({"key": "dob_holder", "value": msg});
        }

        if($('.form-add #avatar').val() === '' && $('.form-add').find('#add').length > 0) {
            msg = 'Trường này không được để trống';
            err.push({"key": "avatar", "value": msg});
        }

        if($('.form-add #email').val() === '') {
            msg = 'Trường này không được để trống';
        } else {
            var pattern = new RegExp(/\S+@\S+\.\S+/);
            if(!pattern.test($('.form-add #email').val())) {
                msg = 'Email không hợp lệ';
            }
        }
        if(msg !== '') {
            err.push({"key": "email", "value": msg});
        }

        if($('.form-add #phone').val() === '') {
            msg = 'Trường này không được để trống';
        } else {
            if(!$.isNumeric($('.form-add #phone').val())){
                msg = 'Chỉ nhận dữ liệu kiểu số';
            } else if($('.form-add #phone').val().length < 10){
                msg = 'Số điện thoải phải có 10 chữ số';
            }
        }
        if(msg !== '') {
            err.push({"key": "phone", "value": msg});
        }

        if(err.length < 1) {
            return true;
        }

        console.log(err)

        for (var index in err) {
            var selector = '.form-add #'+err[index].key;
            var msg = err[index].value;
            showErr($(selector), msg);
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
    });
    
    $('#btn-add').click(function() {
        $(".form-add").animate({ scrollTop: 0 }, "slow");
        $('html').css('overflow','hidden');
        $('#overlay-bg').addClass('show');
        $('.form-add').addClass('show');

        $('.form-add #edit').attr('id', 'add')
        $('.form-add #add').attr('name', 'add')
        $('.form-add #add').val('Thêm thành viên')
    });

    $('.fab').click(function(){
        $('.form-add input[name="id"]').remove();
        $('.form-add').addClass('show');
        $('.popup-user').removeClass('show');
        $('#overlay-bg').addClass('show');
        $('html').css('overflow','hidden');

        if(currentUser.bio == 1) {
            $('#male').prop("checked", true);
        } else {
            $('#female').prop("checked", true);
        }

        $('.form-add #address').val(currentUser.address)
        $('.form-add #course').val(currentUser.course)
        $('.form-add #dob_holder').val(currentUser.dob)
        $( "#dob_holder" ).datepicker( "setDate", currentUser.dob );
        $('.form-add #email').val(currentUser.email)
        $('.form-add #id').val(currentUser.id)
        $('.form-add #name').val(currentUser.fullname)
        $('.form-add #phone').val(currentUser.phone)
        
        $('.form-add #add').attr('id', 'edit')
        $('.form-add #edit').attr('name', 'edit')
        $('.form-add #edit').val('Xác nhận thay đổi')
    });

    $('#overlay-bg').click(function() {
        $(".form-add").scrollTop(0);
        $('html').css('overflow','auto');
        $('#overlay-bg').removeClass('show');
        $('.popup-user').removeClass('show');
        $('.form-add').removeClass('show');
        $('.success').removeClass('show');
        $('p.err').remove();
        $('.form-add').trigger('reset');
    });
    
    var table = $('#myTable').DataTable({
        "serverSide": true,
        "ajax": "http://localhost/SinhVienAPS/Student/newestData",
        "columns": [
            { "data": "fullname" },
            { "data": "phone" },
            { "data": "address" },
            { "data": "bio" },
            { "data": "dob" },
            { "data": "course" },
            { "data": null, "defaultContent": "Xóa" }
        ],
        "columnDefs": [
            {
                "orderable": false,
                "targets": -1,
            },
            {
                "targets": 3,
                "render": function (data, type, row) {
                    if(data === '1') {
                        return 'Nam';
                    }
                    return 'Nữ'
                }
            },
            {
                "targets": 0,
                "render": function (data, type, row) {
                    return '<div class="d-flex">\
                        <div class="avatar mr-2">\
                            <img src="http://localhost/SinhVienAPS/upload/' + row['image'] + '" alt="avatar" width="50px">\
                        </div>\
                        <div class="info">\
                            <div class="name">' + data + '</div>\
                            <div class="email text-muted">' + row['email'] + '</div>\
                        </div>\
                    </div>';
                }
            }
        ],
        "language": {
            "info": "<span class='text-muted'>Hiển thị từ <b class='text-dark'>_START_</b> tới <b class='text-dark'>_END_</b> trong số <b class='text-dark'>_TOTAL_</b> bản ghi</span>",
            "infoEmpty": "<span class='text-muted'>Hiển thị từ <b class='text-dark'>0</b> tới <b class='text-dark'>0</b> trong số <b>0</b> bản ghi</span>",
            "infoFiltered": "<span class='text-muted'>(Lọc từ <b class='text-dark'>_MAX_</b> bản ghi)</span>",
            "zeroRecords": "<span class='text-muted'>Không tìm thấy bản ghi</span>",
            "loadingRecords": "<span class='text-muted'>Đang load dữ liệu...</span>",
            "processing": "<span class='text-muted'>Đang xử lý...</span>",
            "paginate": {
                "next": "Tiếp theo",
                "previous": "Trước đó"
            },
        },
        "dom": "t<'d-flex justify-content-between mt-2'i p>",
        "deferRender": true,
        "pageLength": 5,
    });

    // Search
    $(document).on('keyup', '#search-input', function() {
        table.search( this.value ).draw();
    });

    // Create
    $(document).on('click', '#add', function(event){
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
                    if(jsonData.type === 'success') {
                        console.log('Thành công');
    
                        $('html').css('overflow','auto');
                        $('.form-add').trigger('reset');
                        $('.form-add').removeClass('show');
                        $('.success').addClass('show');
                        table.order([[ 0, 'asc' ]]).draw(false);
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
        $(".form-add").animate({ scrollTop: 0 }, "slow");
    })

    // Read
    $(document).on('click', '#myTable tr td:not(:last-child)', function(event) {
        var uid = table.row(this).data().id;

        $.ajax({
            url: 'http://localhost/SinhVienAPS/index.php/student/info/' + uid,
            type: 'GET',
            success: function (data) {
                var jsonData = JSON.parse(data);
                console.log(jsonData.fullname);
                currentUser = {
                    id: jsonData.id,
                    fullname: jsonData.fullname,
                    address: jsonData.address,
                    bio: jsonData.bio,
                    course: jsonData.course,
                    image: jsonData.image,
                    email: jsonData.email,
                    phone: jsonData.phone,
                    dob: jsonData.dob
                }
                var imageLocation = 'http://' + location.hostname + '/SinhVienAPS/upload/' + currentUser.image;
                $('.popup-user .avatar-lg img').attr('src', imageLocation);

                $('.popup-user .address').html(currentUser.address);
                if (currentUser.bio == 1) {
                    $('.popup-user .bio').html('Nam');
                } else {
                    $('.popup-user .bio').html('Nữ');
                }
                $('.popup-user .course').html(currentUser.course);
                $('.popup-user .dob').html(currentUser.dob);
                $('.popup-user .email').html(currentUser.email);
                $('.popup-user .fullname').html(currentUser.fullname);
                $('.popup-user .phone').html(currentUser.phone);
                
                $('html').css('overflow','hidden');
                $('#overlay-bg').addClass('show');
                $('.popup-user').addClass('show');
            }
        })
    });

    // Edit
    $(document).on('click', '#edit', function(event){
        event.preventDefault();
        
        $('#overlay-bg').addClass('show');
        $('.form-add').addClass('show');
        $('p.err').remove();
        
        // Client-side validate
        // clientIsValid()
        if(clientIsValid()) {
            $.ajax({
                url:  'http://localhost/SinhVienAPS/index.php/student/update/' + currentUser.id,
                type: 'POST',
                data: formData(),
                processData: false,
                contentType: false,
                success: function(data)
                {
                    var jsonData = JSON.parse(data);
                    if(jsonData.type === 'success') {
                        console.log('Thành công');
    
                        $('html').css('overflow','auto');
                        $('.form-add').trigger('reset');
                        $('.form-add').removeClass('show');
                        $('.success').addClass('show');
                        
                        table.order([[ 0, 'asc' ]]).draw(false);
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
                            console.log('update err');
                            $(".form-add").animate({ scrollTop: 0 }, "slow");
                        }
                    }
                }
            })
        }
        $(".form-add").animate({ scrollTop: 0 }, "slow");
    })

    // Delete
    $(document).on('click', '#myTable tr td:last-child', function(event) {
        var uid = table.row(this).data().id;

        if(confirm("Xóa người dùng này ?")) {
            console.log('chọn xoá');
            $.ajax({
                url:  'http://localhost/SinhVienAPS/index.php/student/delete/' + uid,
                type: 'GET',
                success: function(data)
                {
                    var jsonData = JSON.parse(data);
                    if(jsonData.type === 'success') {
                        console.log('Thành công');
                        table.order([[ 0, 'asc' ]]).draw(false);
                    } else {
                        console.log('Không thành công');
                    }
                }
            })
        } else {
            console.log('hủy chọn xóa');
        }
    });
});
