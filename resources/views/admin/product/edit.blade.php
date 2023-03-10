<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sửa sản phẩm</h4>
                <form id="updateProductEdit" class="form-sample" enctype="multipart/form-data">
                    @csrf
                    <p class="card-description">
                        Thông tin sản phẩm
                    </p>
                    <div class="row">
                        <div class="col-md-12">
                                <label class="col-sm-auto col-form-label">Mô tả</label>
                                    <textarea name="description" class="form-control" style="cursor:pointer" value="" id="ckeditor1" rows="4" style="resize: none"></textarea>
                                    <div id="desciptionCategoryEditError" class="form-text text-danger error-msg"></div>
                        </div>
                        <div id="descriptionProductEditError" class="form-text text-danger error-msg"></div>
                    </div><br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Tên sản phẩm</label>
                                <input type="text" id="idProductEdit" class="form-control" hidden/>
                                <div class="col-sm-9">
                                    <input type="text" id="nameProductEdit" name="name" class="form-control"
                                        placeholder="Nhập họ và tên" />
                                    <div id="nameProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giá sản phẩm</label>
                                <div class="col-sm-9">
                                    <input type="text" id="priceProductEdit" name="price" class="form-control"
                                        placeholder="Nhập số điện thoại" />
                                    <div id="priceProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Danh mục</label>
                                <div class="col-sm-9">
                                    <select id="categoryProductEdit" name="category_id" class="form-control">
                                        <option value="">--- Chọn danh mục --- </option>
                                        @if(isset($categories) && !empty($categories))
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div id="categoryProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Số lượng</label>
                                <div class="col-sm-9">
                                    <input type="number" id="quantityProductEdit" name="quantity" class="form-control"
                                        placeholder="Nhập số lượng" />
                                    <div id="quantityProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Giảm giá</label>
                                <div class="col-sm-9">
                                    <select class="form-control" class="form-control" id="discountEdit" name="discount">
                                        <option selected value=''>--Không giảm giá--</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Chọn size</label>
                                <div class="col-sm-9">
                            <select id="sizeEdit" class="form-select" name="sizes[]" multiple aria-label="multiple select example">
                             
                            </select>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Nhà cung cấp</label>
                                <div class="col-sm-9">
                                    <select id="supplierProductEdit"  name="supplier_id" class="form-control">
                                        <option value="">--- Chọn nhà cung cấp --- </option>
                                        @if(isset($suppliers) && !empty($suppliers))
                                        @foreach ($suppliers as $supplier)
                                        <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                                        @endforeach
                                        @endif
                                    </select>
                                    <div id="supplierProductEditError" class="form-text text-danger error-msg"></div>
                                </div>
                            </div>
                         
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Trạng thái</label>
                                <div class="col-sm-4">
                                    <select id="statusProductEdit" name="status" class="form-control">
                                        <option value="1">Hiện sản phẩm</option>
                                        <option value="0">Ẩn sản phẩm</option>
                                    </select>
                                </div>
                                <div class="col-sm-4">
                                    <select id="type_genderProductEdit" name="type_gender" class="form-control">
                                        <option value="Nam">Nam</option>
                                        <option value="Nữ">Nữ</option>
                                        <option value="All">Cả Nam/Nữ</option>
                                    </select>
                                </div>
                               
                                <div id="type_genderProductEditError" class="form-text text-danger error-msg"></div>

                            </div>
                            
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label">Ảnh sản phẩm</label>
                                <div class="col-sm-9">
                                    <input accept="image/*" type='file' class="form-control"
                                        id="imageProductEdit" name="inputFile" />
                                    <div id="imageProductEditError" class="form-text text-danger error-msg"></div>
                                    <img type="hidden" width="390px" height="350px" id="blah1" src=""
                                        alt="" />
                                </div>

                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group row">

                                <label class="col-sm-3 col-form-label">Ảnh chi tiết</label>
                                    <div class="col-sm-9 form_input_edit">
                                        <span class="selectEdit"></span>
                                        <input type="file" name="file_names[]" id="file_name_edit" multiple
                                            class="form-control"><br>
                                            <div class="container_image_edit">
                                            <div id="imageManyProductEditError" class="form-text text-danger error-msg"></div>
                                         
                                    </div>
                                    </div>
                            </div>
                        </div>

                       
                    </div> 
                    <button type="submit" id="confirmUpdateProductEdit" class="btn btn-primary me-2">Sửa</button>
                    <button class="btn btn-light" data-bs-dismiss="modal">Hủy</button>
                </form>
            </div>
        </div>
    </div>
</div>
