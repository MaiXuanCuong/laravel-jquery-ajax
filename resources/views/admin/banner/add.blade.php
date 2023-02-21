<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm ảnh bìa</h4>
                <form id="insertBanner" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin ảnh bìa
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                                  <label class="col-sm-3 col-form-label">Ảnh</label>
                                  <div class="col-sm-9">
                                  <input accept="image/*" type='file' class="form-control"
                                      id="imageBanner" name="inputFileAdd" />


                                  <div id="imageBannerAddError" class="form-text text-danger error-msg"></div>
                                  <img type="hidden" width="390px" height="300px" id="blah" src=""
                                      alt="" />
                                </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label">Trạng thái</label>
                            <div class="col-sm-4">
                                <select id="statusBanner" name="status" class="form-control">
                                    <option value="1">Hiện ảnh bìa</option>
                                    <option value="0">Ẩn ảnh bìa</option>
                                </select>
                            </div>
                            <div id="statusBannerAddError" class="form-text text-danger error-msg"></div>
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
