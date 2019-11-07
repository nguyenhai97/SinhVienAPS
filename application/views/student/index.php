<div class="container">
    <div class="row my-3">
        <h3 class="text-title">Danh sách thành viên</h3>
        <button class="btn ml-auto btn-primary" id="btn-add"><span style="margin-right: 0.5em"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#fff"><path class="heroicon-ui" d="M19 10h2a1 1 0 0 1 0 2h-2v2a1 1 0 0 1-2 0v-2h-2a1 1 0 0 1 0-2h2V8a1 1 0 0 1 2 0v2zM9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2z"/></svg></span><span>Thêm thành viên</span></button>
    </div>
    <div class="table-responsive">
        <table class="table table-hover table-borderless">
            <thead>
                <tr>
                    <th nowrap class="text-uppercase text-gray basic_info">Thông tin cơ bản</th>
                    <th nowrap class="text-uppercase text-gray address">Địa chỉ</th>
                    <th nowrap class="text-uppercase text-gray bio">Giới tính</th>
                    <th nowrap class="text-uppercase text-gray dob">Ngày sinh</th>
                    <th nowrap class="text-uppercase text-gray course">lớp</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($students as $student): ?>
                <tr>
                    <td class="d-flex">
                        <div class="avatar mr-2">
                            <img src="<?= base_url('upload/'.$student->image) ?>" alt="avatar" width="50px" height="50px">
                        </div>
                        <div class="info">
                            <div class="name"><?= $student->fullname ?></div>
                            <div class="email text-muted"><?= $student->email ?></div>
                        </div>
                    </td>
                    <td class="text-capitalize address"><?= $student->address ?></td>
                    <td class="bio"><?= ($student->bio == 1)? 'Nam' : 'Nữ' ?></td>
                    <td class="dob"><?php
                        $date = new DateTime($student->dob);
                        echo $date->format('d/m/Y');
                    ?></td>
                    <td class="course"><?= $student->course ?></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
    <nav class="d-flex justify-content-center">
        <ul class="pagination">
            <?php echo $pagination; ?>
        </ul>
    </nav>
    <?= form_open('',array('class'=>'form-add','id'=>'form-add')) ?>
        <div class="form-group">
            <label for="name">Họ và tên</label>
            <input type="text" name="fullname" class="form-control" id="name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" class="form-control" id="email">
        </div>
        <div class="custom-radio">
            <div>Giới tính</div>
            <div class="d-inline mr-2">
                <input type="radio" name="bio" value="1" id="male" checked>
                <label class="" for="male">Nam</label>
            </div>
            <div class="d-inline">
                <input type="radio" name="bio" value="0" id="female">
                <label class="" for="female">Nữ</label>
            </div>
        </div>
        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input name="address" type="text" class="form-control" id="address">
        </div>
        <div class="form-group">
            <label for="course">Lớp</label>
            <input type="text" name="course" class="form-control" id="course">
        </div>
        <div class="form-group">
            <label for="phone">Số điện thoại</label>
            <input name="phone" type="tel" class="form-control" id="phone">
        </div>
        <div class="form-group">
            <label for="dob_holder">Ngày tháng năm sinh</label>
            <input name="dob_holder" type="text" class="form-control" id="dob_holder">
            <input name="dob" type="hidden" id="dob">
        </div>
        <div class="form-group">
            <label for="avatar">Ảnh</label>
            <input name="avatar" class="w-100" type="file" id="avatar">
        </div>
        <div style="text-align: center;">
            <input type="submit" name="submit" class="btn btn-primary mb-2" id="submit" value="Thêm thành viên">
        </div>
    </form>
    <div class="success text-success-2">
        <div class="d-flex align-items-center">
            <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" fill="#22543D"><path class="heroicon-ui" d="M9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2zm-1.3-10.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg></span>
            <span>Thêm thành công</span>
        </div>
    </div>
    <div class="popup-user">
    </div>
    <div id="overlay-bg"></div>
</div>