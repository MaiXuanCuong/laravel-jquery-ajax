@extends('admin.layout.master')
@section('content')
    <div class="content-wrapper">
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <button type="button" class="btn btn-primary" id="addUser" data-bs-toggle="modal">
                    Thêm nhân viên
                </button> &emsp;
                <button type="button" class="btn btn-danger" id="trashCanUser" data-bs-toggle="modal">
                  Thùng Rác
              </button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Danh sách nhân viên</h4>
                        <p class="card-description">
                            Làm việc tại <code>Xuân Cường Shop</code>
                        </p>
                        <div class="table-responsive">
                            <table class="table table-hover text-align-center">
                                <thead>
                                    <tr>
                                        <th>Ảnh Đại Diện</th>
                                        <th>Tên Nhân Viên</th>
                                        <th>Giới Tính</th>
                                        <th>Số Điện Thoại</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>

                                <tbody id="index-users">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>;
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                @include('admin.user.edit')
            </div>
        </div>
    </div>

    <div class="modal fade" id="addUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">

                @include('admin.user.add')
            </div>
        </div>
    </div>

    <div class="modal fade" id="confirmUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">

                @include('admin.user.confirm')
            </div>
        </div>
    </div>

    <div class="modal fade" id="trashCanUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl">
          <div class="modal-content">

              @include('admin.user.trashcan')
          </div>
      </div>
  </div>

  <div class="modal fade" id="inforUserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            @include('admin.user.infor')
        </div>
    </div>
</div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="{{ asset('asset/jqueryajax/ajaxUser.js') }}"></script>
@endsection
