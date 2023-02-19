<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa sản phẩm</h4>
                <form id="updateProduct" class="form-sample" method="POST" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin sản phẩm
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhân viên</label>
                                <div class="col-sm-9">
                                    <input type="text" id="idProductEdit" class="form-control" hidden />
                                    <input type="text" id="nameProductEdit" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phoneProductEdit" name="phone" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="phoneProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giới tính</label>
                                <div class="col-sm-9">
                                    <select id="genderProductEdit" name="gender" class="form-control">
                                        <option value="">--- Chọn giới tính --- </option>
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="Khác">Khác</option>
                                    </select>
                                    <div id="genderProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ngày sinh</label>
                                <div class="col-sm-9">
                                    <input type="date" id="birthdayProductEdit" name="birthday" class="form-control"
                                        placeholder="dd/mm/yyyy" />
                                    <div id="birthdayProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input class="form-control" name="email" id="emailProductEdit"
                                        placeholder="Nhập email" />
                                    <div id="emailProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tỉnh/Thành Phố</label>
                                        <select name="province_id" class="form-control province_id"
                                            id="province_edit_id">
                                            <option selected="" value="">Chọn Tỉnh/Thành Phố</option>

                                        </select>
                                        <div id="provincesProductEditError" class="form-text text-danger error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Quận/Huyện</label>
                                        <select name="district_id" class="form-control district_id"
                                            id="district_edit_id">

                                        </select>
                                        <div id="districtsProductEditError" class="form-text text-danger error-msg"></div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Xã/Phường</label>
                                        <select name="ward_id" class="form-control ward_id" id="ward_edit_id">

                                        </select>
                                        <div id="wardProductEditError" class="form-text text-danger error-msg"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <div class="form-group">
                                    <label class="col-sm-3 col-form-label">Ảnh</label>
                                    <input accept="image/*" type='file' class="file-upload-default"
                                        id="imageProductEdit" name="inputFileUpdate" />
                                    <div id="imageProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                                <img type="hidden" width="90px" height="350px" id="blah1" src=""
                                    alt="" />
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="confirmUpdateProduct" class="btn btn-primary me-2">Sửa</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
