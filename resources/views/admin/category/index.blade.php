@extends('admin.layout.master')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-primary" id="addCategory" data-bs-toggle="modal">
                Thêm danh mục
            </button> &emsp;
            <button type="button" class="btn btn-danger" id="trashCanCategory" data-bs-toggle="modal">
              Thùng Rác
          </button>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách danh mục</h4>
                    <p class="card-description">
                        Có tại <code>Xuân Cường Shop</code>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover text-align-center">
                            <thead>
                                <tr>
                                    <th>Ảnh Danh Mục</th>
                                    <th>Tên Danh Mục</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>

                            <tbody id="index-categories">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            @include('admin.category.edit')
        </div>
    </div>
</div>

<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            @include('admin.category.add')
        </div>
    </div>
</div>

<div class="modal fade" id="trashCanCategoryModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">

          @include('admin.category.trashcan')
      </div>
  </div>
</div>
<div class="modal fade" id="inforCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            @include('admin.category.infor')
        </div>
    </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('asset/jqueryajax/ajaxCategory.js') }}"></script>
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('ckeditor');
    CKEDITOR.replace('ckeditor1');
</script>



@endsection

