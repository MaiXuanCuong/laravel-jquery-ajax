
<style>
  .alert-body-title {
  color: #000;
  font-size: 1.5rem;
  font-weight: bold;
  overflow-wrap: break-word;
  word-wrap: break-word;
  word-break: break-word;
}

.alert-body-message {
  padding-top: 5px;
  color: #aaa;
  font-size: 1.1rem;
  text-align: justify;
  overflow-wrap: break-word;
  word-wrap: break-word;
  word-break: break-word;
}
</style>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="modal-header">
          <img style="width: 455px;height: 200px;" src="https://www.studytienganh.vn/upload/2021/05/98162.jpg" alt="">
        </div>
        <div class="card-body">
          <div class="container">
            <input type="text" id="confirm_delete_user" hidden>
            <span class="alert-body-title">Bạn có chắn chắn?</span>
            <span class="alert-body-message">Với hành động này?</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Thôi không xóa!</button>
          <button type="button" class="btn btn-danger" id="confirm-true">Xóa đi!</button>
        </div>
      </div>
    </div>
  </div>
  