<div class="container">
    <!-- Headline -->
    <div class="row d-flex justify-content-between flex-wrap my-3 mx-1">
        <div class="d-flex items-center">
            <h3 class="text-title">Danh sách thành viên</h3>
            <div class="filter ml-2">
                <!-- fixed bio -->
                <select name="filter-bio" class="custom-select" id="filter-bio">
                    <option value="">Theo giới tính</option>
                    <option value="1">Nam</option>
                    <option value="0">Nữ</option>
                </select>
                <!-- Load lớp qua ajax -->
                <select name="filter-course" class="custom-select ml-1" id="filter-course">
                    <option value="">Theo lớp</option>
                    <option value="">CNTT_K14C</option>
                    <option value="">CNTT_K14D</option>
                    <option value="">CNTT_K14E</option>
                </select>
            </div>
        </div>
        <div class="d-flex">
            <div class="search mr-2">
                <div class="h-100 position-relative">
                    <input type="text" placeholder="Tìm kiếm trong bảng" id="search-input">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="23" height="23" id="search-icon"><path class="heroicon-ui" d="M16.32 14.9l5.39 5.4a1 1 0 0 1-1.42 1.4l-5.38-5.38a8 8 0 1 1 1.41-1.41zM10 16a6 6 0 1 0 0-12 6 6 0 0 0 0 12z"/></svg>
                </div>
            </div>
            <div class="add-member">
                <button class="btn btn-primary" id="btn-add">+</button>
            </div>
        </div>
    </div>
    <!-- Data Table -->
    <table id="myTable" class="w-100">
        <thead>
            <tr>
                <th>Thông tin cơ bản</th>
                <th>Số điện thoại</th>
                <th>Địa chỉ</th>
                <th>Giới tính</th>
                <th>Ngày sinh</th>
                <th>Lớp</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <!-- Form -->
    <?=form_open('', array('class' => 'form-add', 'id' => 'form-add'))?>
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
        <div class="form-group" style="text-align: center;">
            <input type="submit" name="submit" class="btn btn-primary" id="add" value="Thêm thành viên">
        </div>
    </form>
    <!-- Success Message -->
    <div class="success text-success-2">
        <div class="d-flex align-items-center">
            <span class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="30" height="30" fill="#22543D"><path class="heroicon-ui" d="M9 12A5 5 0 1 1 9 2a5 5 0 0 1 0 10zm0-2a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm8 11a1 1 0 0 1-2 0v-2a3 3 0 0 0-3-3H7a3 3 0 0 0-3 3v2a1 1 0 0 1-2 0v-2a5 5 0 0 1 5-5h5a5 5 0 0 1 5 5v2zm-1.3-10.7l1.3 1.29 3.3-3.3a1 1 0 0 1 1.4 1.42l-4 4a1 1 0 0 1-1.4 0l-2-2a1 1 0 0 1 1.4-1.42z"/></svg></span>
            <span style="font-size:1.5em">Thành công</span>
        </div>
    </div>
    <!-- User details -->
    <div class="popup-user">
        <div class="inner position-relative">
            <div class="main-info text-center py-2">
                <div class="avatar-lg mx-auto">
                    <img src="http://localhost/SinhVienAPS/upload/fallback.png" alt="avatar" width="150px">
                </div>
                <div class="fullname text-lg font-weight-bold">...</div>
                <div class="email text-sm text-muted">...</div>
            </div>
            <div class="info-group">
                <div class="item d-flex justify-content-between py-2">
                    <div class="label">Ngày tháng năm sinh:</div>
                    <div class="dob value">...</div>
                </div>
                <div class="item d-flex justify-content-between py-2">
                    <div class="label">Giới tính:</div>
                    <div class="bio value">...</div>
                </div>
                <div class="item d-flex justify-content-between py-2">
                    <div class="label">Địa chỉ:</div>
                    <div class="address value">...</div>
                </div>
                <div class="item d-flex justify-content-between py-2">
                    <div class="label">Số điện thoại:</div>
                    <div class="phone value">...</div>
                </div>
                <div class="item d-flex justify-content-between py-2">
                    <div class="label">Lớp học:</div>
                    <div class="course value">...</div>
                </div>
            </div>
            <div class="fab">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#ffffff" viewBox="0 0 24 24" width="24" height="24"><path class="heroicon-ui" d="M6.3 12.3l10-10a1 1 0 0 1 1.4 0l4 4a1 1 0 0 1 0 1.4l-10 10a1 1 0 0 1-.7.3H7a1 1 0 0 1-1-1v-4a1 1 0 0 1 .3-.7zM8 16h2.59l9-9L17 4.41l-9 9V16zm10-2a1 1 0 0 1 2 0v6a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6c0-1.1.9-2 2-2h6a1 1 0 0 1 0 2H4v14h14v-6z"/></svg>
            </div>
        </div>
    </div>
    <div id="overlay-bg"></div>
</div>