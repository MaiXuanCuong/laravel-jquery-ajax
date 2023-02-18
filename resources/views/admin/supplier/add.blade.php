<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm nhân viên</h4>
                <form id="insertSupplier" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin nhân viên
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhà cung cấp</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nameSupplier" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameSupplierAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phoneSupplier" name="phone" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="phoneSupplierAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" id="emailSupplier" name="email" class="form-control"
                                    placeholder="Nhập số điện thoại" />
                                    <div id="emailSupplierAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" id="addressSupplier" name="address" class="form-control"
                                        placeholder="Nhập địa chỉ" />
                                    <div id="addressSupplierAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="" class="btn btn-primary me-2">Thêm</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
