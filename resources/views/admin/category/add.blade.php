<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm danh mục</h4>
                <form id="insertCategory" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin danh mục
                    </p>
                    <div class="row">
                        <div class="col-md-12">
                                <label class="col-sm-auto col-form-label">Mô tả</label>
                                    <textarea name="description" class="form-control is-invalid" value="" id="ckeditor" rows="4" style="resize: none"></textarea>
                                    <div id="desciptionCategoryAddError" class="form-text text-danger error-msg"></div>
                        </div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên danh mục</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nameCategory" name="name" class="form-control"
                                        placeholder="Nhập tên danh mục" />
                                    <div id="nameCategoryAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Ảnh</label>
                                  <div class="col-sm-9">
                                  <input accept="image/*" type='file' class="form-control"
                                      id="imageCategory" name="inputFileAdd" />


                                  <div id="imageCategoryAddError" class="form-text text-danger error-msg"></div>
                                  <img type="hidden" width="390px" height="300px" id="blah" src=""
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
