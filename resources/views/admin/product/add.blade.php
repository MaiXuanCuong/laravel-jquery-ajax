<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm Sản phẩm</h4>
                <form id="insertUser" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin sản phẩm
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nameUser" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá</label>
                                <div class="col-sm-9">
                                    <input type="text" id="priceUser" name="price" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="priceUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giới tính</label>
                                <div class="col-md-12">
                                    <label class="col-sm-auto col-form-label">Mô tả</label>
                                        <textarea name="description" class="form-control is-invalid" value="" id="ckeditor" rows="4" style="resize: none"></textarea>
                                        <div id="desciptionProductAddError" class="form-text text-danger error-msg"></div>
                            </div>
                        </div><br><br>
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Ảnh</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type='file' class="file-upload-default"
                                        id="imageUser" name="inputFileAdd" />
                                    <div id="imageUserAddError" class="form-text text-danger error-msg"></div>
                                </div>
                                <img type="hidden" width="90px" height="350px" id="blah" src=""
                                    alt="" />
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
