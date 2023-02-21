<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm nhân viên</h4>
                <form id="insertUser" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin nhân viên
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhân viên</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nameUser" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phoneUser" name="phone" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="phoneUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giới tính</label>
                                <div class="col-sm-9">
                                    <select id="genderUser" name="gender" class="form-control">
                                        <option value="">--- Chọn giới tính --- </option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Khác">Khác</option>
                                    </select>
                                    <div id="genderUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ngày sinh</label>
                                <div class="col-sm-9">
                                    <input type="date" id="birthdayUser" name="birthday" class="form-control"
                                        placeholder="dd/mm/yyyy" />
                                    <div id="birthdayUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input class="form-control" id="emailUser" name="email"
                                        placeholder="Nhập email" />
                                    <div id="emailUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center mb-4">
                                <i class='fa fa-address-book fa-lg me-3 fa-fw'></i>
                                <div class="form-outline flex-fill mb-0">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Tỉnh/Thành Phố</label>
                                                <select name="province_id" id="province_id"
                                                    class="form-control province_id" aria-label="Default select example"
                                                    data-toggle="select2">
                                                    <option selected="" value="">Chọn Tỉnh/Thành Phố</option>
                                                </select>
                                                <div id="provincesUserAddError" class="form-text text-danger error-msg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Quận/Huyện</label>
                                                <select name="district_id" id="district_id"
                                                    class="form-control district_id"
                                                    aria-label="Default select example">
                                                    <option selected="" value="">Chọn Quận/Huyện</option>
                                                </select>
                                                <div id="districtsUserAddError" class="form-text text-danger error-msg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Xã/Phường</label>
                                                <select name="ward_id" class="form-control ward_id"
                                                    aria-label="Default select example" id="ward_id">
                                                    <option selected="" value="">Chọn Xã/Phường</option>
                                                </select>
                                                <div id="wardsUserAddError" class="form-text text-danger error-msg">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type='file' class="form-control"
                                        id="imageUser" name="inputFileAdd" />
                                    <div id="imageUserAddError" class="form-text text-danger error-msg"></div>
                                    <img type="hidden" width="390px" height="350px" id="blah" src=""
                                        alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary me-2">Thêm</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
