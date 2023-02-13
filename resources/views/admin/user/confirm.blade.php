
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
.text-align-center{
  text-align: center;
}
</style>
<div class="row">
    <div class="col-12">
      <div class="card">
        <div class="modal-header">
          <img style="width: 455px;height: 200px;" src="https://www.studytienganh.vn/upload/2021/05/98162.jpg" alt="">
        </div>
        <div class="card-body">
          <div class="container text-align-center">
            <input type="text" id="confirm" hidden>
            <span class="alert-body-title">Bạn có chắc chắn?</span><br>
            <span class="alert-body-message" id="confirm-text"></span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Không đồng ý!</button>
          <button type="button" class="btn btn-danger" id="confirm-true">Đồng ý!</button>
        </div>
      </div>
    </div>
  </div>
  