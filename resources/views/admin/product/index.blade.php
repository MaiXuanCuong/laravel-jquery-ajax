@extends('admin.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <button type="button" class="btn btn-primary" id="addProduct" data-bs-toggle="modal">
                    Thêm sản phẩm
                </button> &emsp;
                <button type="button" class="btn btn-danger" id="trashCanProduct" data-bs-toggle="modal">
                  Thùng Rác
              </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách sản phẩm</h4>
                        <p class="card-description">
                            Có tại <code>Xuân Cường Shop</code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover text-align-center">
                                <thead>
                                    <tr>
                                        <th>Ảnh sản phẩm</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Giá</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody id="index-products">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>;
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                @include('admin.product.edit')
            </div>
        </div>
    </div>

    <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                @include('admin.product.add')
            </div>
        </div>
    </div>
    <div class="modal fade" id="trashCanProductModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
       
          <div class="modal-content">

              @include('admin.product.trashcan')
          </div>
       
      </div>
  </div>

  <div class="modal fade" id="inforProductModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">

        <div class="modal-content">

            @include('admin.product.infor')
        </div>
    </div>
</div>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('asset/jqueryajax/ajaxProduct.js') }}"></script>
    <script src="{{ asset('asset/jqueryajax/uploadFile.js') }}"></script>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('ckeditor');
        // CKEDITOR.replace('ckeditor1');
    </script>
@endsection
