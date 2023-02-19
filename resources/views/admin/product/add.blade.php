<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Thêm sản phẩm</h4>
                <form id="insertProduct" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin sản phẩm
                    </p>
                    <div class="row">
                        <div class="col-md-12">
                                <label class="col-sm-auto col-form-label">Mô tả</label>
                                    <textarea name="description" class="form-control" style="cursor:pointer" value="" id="ckeditor" rows="4" style="resize: none"></textarea>
                                    <div id="desciptionCategoryAddError" class="form-text text-danger error-msg"></div>
                        </div>
                        <div id="descriptionProductAddError" class="form-text text-danger error-msg"></div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" id="nameProduct" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameProductAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" id="priceProduct" name="price" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="priceProductAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Danh mục</label>
                                <div class="col-sm-9">
                                    <select id="categoryProduct" name="category_id" class="form-control">
                                        <option value="">--- Chọn danh mục --- </option>
                                        @if(isset($categories) && !empty($categories))
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div id="categoryProductAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số lượng</label>
                                <div class="col-sm-9">
                                    <input type="number" id="quantityProduct" name="quantity" class="form-control"
                                        placeholder="Nhập số lượng" />
                                    <div id="quantityProductAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhà cung cấp</label>
                                <div class="col-sm-9">
                                    <select id="supplierProduct"  name="supplier_id" class="form-control">
                                        <option value="">--- Chọn nhà cung cấp --- </option>
                                        @if(isset($suppliers) && !empty($suppliers))
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div id="supplierProductAddError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                         
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-4">
                                    <select id="statusProduct" name="status" class="form-control">
                                        <option value="1">Hiện sản phẩm</option>
                                        <option value="0">Ẩn sản phẩm</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="type_genderProduct" name="type_gender" class="form-control">
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="All">Cả Nam/Nữ</option>
                                    </select>
                                </div>
                                <div id="type_genderProductAddError" class="form-text text-danger error-msg"></div>

                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label">Ảnh sản phẩm</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type='file' class="form-control"
                                        id="imageProduct" name="inputFileAdd" />
                                    <div id="imageProductAddError" class="form-text text-danger error-msg"></div>
                                    <img type="hidden" width="390px" height="350px" id="blah" src=""
                                        alt="" />
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label">Ảnh chi tiết</label>
                                    <div class="col-sm-9 form_input">
                                        <span class="inner"><span class="select"></span>
                                        </span>
                                        <input type="file" name="file_names[]" id="file_name" multiple
                                            class="form-control"><br>
                                            <div class="container_image">
                                            <div id="imageManyProductAddError" class="form-text text-danger error-msg"></div>
                                         
                                    </div>
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
