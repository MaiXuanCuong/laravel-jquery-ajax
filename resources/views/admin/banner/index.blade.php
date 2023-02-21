@extends('admin.layout.master')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <button type="button" class="btn btn-primary" id="addBanner" data-bs-toggle="modal">
                Thêm ảnh bìa
            </button> &emsp;
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Danh sách ảnh bìa</h4>
                    <p class="card-description">
                        Có tại <code>Xuân Cường Shop</code>
                    </p>
                    <div class="table-responsive">
                        <table class="table table-hover text-align-center">
                            <thead>
                                <tr>
                                    <th>Ảnh bìa</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody id="index-banners">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
 <!-- Modal -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('admin.banner.edit')
        </div>
    </div>
</div>
<div class="modal fade" id="addBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('admin.banner.add')
        </div>
    </div>
</div>
<div class="modal fade" id="inforBannerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            @include('admin.banner.infor')
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
<script src="{{ asset('asset/jqueryajax/ajaxBanner.js') }}"></script>
@endsection

