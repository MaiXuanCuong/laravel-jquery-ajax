<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chỉnh sửa nhân viên</h4>
                <form id="updateSupplier" class="form-sample">
                    @csrf
                    <p class="card-description">
                        Thông tin nhân viên
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên nhà cung cấp</label>
                                <div class="col-sm-9">
                                    <input type="text" id="idSupplierEdit" class="form-control" hidden />
                                    <input type="text" id="nameSupplierEdit" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameSupplierEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số điện thoại</label>
                                <div class="col-sm-9">
                                    <input type="text" id="phoneSupplierEdit" name="phone" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="phoneSupplierEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input type="text" id="emailSupplierEdit" name="email" class="form-control"
                                    placeholder="Nhập email" />
                                    <div id="emailSupplierEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Địa chỉ</label>
                                <div class="col-sm-9">
                                    <input type="text" id="addressSupplierEdit" name="address" class="form-control"
                                        placeholder="Nhập địa chỉ" />
                                    <div id="addressSupplierEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="confirmUpdateSupplier" class="btn btn-primary me-2">Sửa</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
