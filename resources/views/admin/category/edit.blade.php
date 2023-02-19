<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Chỉnh sửa danh mục</h4>
          <form id="updateCategory" class="form-sample" method="POST" enctype="multipart/form-data">
            @csrf
            <p class="card-description">
              Thông tin danh mục
            </p>
            <div class="row">
              <div class="col-md-12">
                  <label class="col-sm-3 col-form-label">Mô tả</label>
                    <input type="text" id="idCategoryEdit" class="form-control" hidden/>
                    {{-- <input type="text" id="descriptionCategoryEdit" name="description" class="form-control" placeholder="Nhập mô tả danh mục"/> --}}
                    <textarea name="description" class="form-control is-invalid" id="ckeditor1" rows="4" style="resize: none"></textarea>

                    <div id="nameCategoryEditError" class="form-text text-danger error-msg"></div>
              </div>
           
            </div><br><br>
           
            <div class="row">
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Tên danh mục</label>
                  <div class="col-sm-9">
                    <input type="text" id="nameCategoryEdit" name="name" class="form-control" placeholder="Nhập tên danh mục"/>
                    <div id="nameCategoryEditError" class="form-text text-danger error-msg"></div>
                  </div>
                </div>
              </div>
            
                <div class="col-md-6">
                  <div class="form-group row">
                <label class="col-sm-3 col-form-label">Ảnh</label>
                <div class="col-sm-9">
                <input accept="image/*" type='file' class="form-control" id="imageCategoryEdit" name="inputFileUpdate" />
                <div id="imageCategoryEditError" class="form-text text-danger error-msg"></div>
              </div>
              <img type="hidden" width="90px" height="350px" id="blah1" src=""
              alt="" />
            </div>
            </div>
         
            </div>
            <button type="submit" id="confirmeditCategory" class="btn btn-primary me-2">Sửa</button>
            <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  