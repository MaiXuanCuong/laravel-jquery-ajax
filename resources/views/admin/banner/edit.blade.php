<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Chỉnh sửa ảnh bìa</h4>
          <form id="updateBanner" class="form-sample" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="card-description">
              Thông tin ảnh bìa
            </p>
            <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <label class="col-sm-3 col-form-label">Ảnh</label>
                      <div class="col-sm-9">
                        <input type="text" id="idBannerEdit" class="form-control" hidden/>
                      <input accept="image/*" type='file' class="form-control" id="imageBannerEdit" name="inputFileUpdate" />
                      <div id="imageBannerEditError" class="form-text text-danger error-msg"></div>
                      <img type="hidden" width="390px" height="350px" id="blah1" src=""
                      alt="" />
                </div>
            </div>
            </div>
            <div class="col-md-6">
              <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Trạng thái</label>
                  <div class="col-sm-4">
                      <select id="statusBannerEdit" name="status" class="form-control">
                          <option value="1">Hiện sản phẩm</option>
                          <option value="0">Ẩn sản phẩm</option>
                      </select>
                  </div>
                  <div id="statusBannerEditError" class="form-text text-danger error-msg"></div>
              </div>
          </div>
            </div>

            <button type="submit" id="confirmeditBanner" class="btn btn-primary me-2">Sửa</button>
            <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  