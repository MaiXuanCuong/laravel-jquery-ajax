@extends('admin.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <button type="button" class="btn btn-primary" id="addSupplier" data-bs-toggle="modal">
                    Thêm nhà cung cấp
                </button> &emsp;
                <button type="button" class="btn btn-danger" id="trashCanSupplier" data-bs-toggle="modal">
                  Thùng Rác
              </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách nhà cung cấp</h4>
                        <p class="card-description">
                            Có tại <code>Xuân Cường Shop</code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover text-align-center">
                                <thead>
                                    <tr>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Số điện thoại</th>
                                        <th>Địa chỉ</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody id="index-suppliers">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>;
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                @include('admin.supplier.edit')
            </div>
        </div>
    </div>

    <div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                @include('admin.supplier.add')
            </div>
        </div>
    </div>
    <div class="modal fade" id="trashCanSupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">

              @include('admin.supplier.trashcan')
          </div>
      </div>
  </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('asset/jqueryajax/ajaxSupplier.js') }}"></script>
@endsection
