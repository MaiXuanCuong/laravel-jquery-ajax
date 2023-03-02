
    <style>
    .modal-header .btn-close {
    padding: 2.5px 13px;
    margin: 1.5px 25px -12.5px auto;
}
    </style>
    <div id="app">
        <div class="app-content">
            <div class="u-s-p-b-60">
                <div class="section__content">
                    <div class="container">
                        <div class="checkout-f">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">Thông tin giao hàng</h1>
                                    <form class="checkout-f__delivery" id="form-checkout" method="POST">
                                        @csrf
                                        <div class="u-s-m-b-30">
                                            <div class="u-s-m-b-15">
                                            </div>
                                            <div class="gl-inline">
                                                <div class="u-s-m-b-15">
                                                    <label class="gl-label" for="billing-fname">Họ và tên *</label>
                                                    <input class="input-text input-text--primary-style" type="text" name="name" placeholder="Nhập tên người nhận" data-bill="" id="name-receiver">
                                                    <div id="nameReceiverError" class="form-text text-danger"></div>
                                                </div>
                                            </div>
                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-phone">Số điện thoại *</label>
                                                <input class="input-text input-text--primary-style" type="text" name="phone"  placeholder="Nhập số điện thoại" data-bill="" id="phone-receiver">
                                                <div id="phoneReceiverError" class="form-text text-danger"></div>
                                            </div>
                                                
                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-street">Địa chỉ giao(Vị trí bạn nhận hàng) *</label>
                                                <input class="input-text input-text--primary-style" type="text" name="address"  placeholder="Nhập nơi nhận hàng của bạn" data-bill="" id="address-receiver">
                                                <div id="addressReceiverError" class="form-text text-danger"></div>
                                            </div>
                                            <div class="u-s-m-b-15">
                                                <label class="gl-label" for="billing-country">Tỉnh/Thành phố*</label>
                                                <select name="province_id" id="province_id"
                                                class="select-box select-box--primary-style province_id" aria-label="Default select example"
                                                data-toggle="select2">
                                                <option selected="" value="">Chọn Tỉnh/Thành Phố</option>
                                            </select>
                                            <div id="provincesReceiverError" class="form-text text-danger error-msg">
                                            </div>
                                        </div>
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-town-city">Quận/Huyện *</label>

                                                    <select name="district_id" id="district_id"
                                                    class="select-box select-box--primary-style district_id"
                                                    aria-label="Default select example">
                                                    <option selected="" value="">Chọn Quận/Huyện</option>
                                                </select>
                                            
                                                <div id="districtsReceiverError" class="form-text text-danger error-msg">
                                                </div>
                                            </div>
                                            <div class="u-s-m-b-15">

                                                <label class="gl-label" for="billing-state">Xã/Phường *</label>
                                                <select name="ward_id" class="select-box select-box--primary-style ward_id"
                                                aria-label="Default select example" id="ward_id">
                                                <option selected="" value="">Chọn Xã/Phường</option>
                                            </select>
                                            <div id="wardsReceiverError" class="form-text text-danger error-msg">
                                            </div>
                                        </div>
                                            <div class="u-s-m-b-10">

                                                <a class="gl-link"  data-toggle="collapse">Bạn có mã giảm giá từ shop?</a></div>
                                            <div class="collapse u-s-m-b-15" id="create-account">

                                                <span class="gl-text u-s-m-b-15">Nhập mã giảm giá của bạn vào đây, vui nhập đúng chữ hoa và chữ thường</span>
                                                <div>

                                                    <label class="gl-label" for="reg-password">Mã giảm giá *</label>

                                                    <input class="input-text input-text--primary-style" name="discount" type="text" data-bill ></div>
                                            </div>
                                            <div class="u-s-m-b-10">

                                                <label class="gl-label" for="order-note">Ghi chú(vd: yêu cầu thời gian giao hàng,v.v)</label><textarea class="text-area text-area--primary-style" name="note" id="order-note"></textarea></div>
                                            <div>

                                                <button class="btn btn--e-brand-b-2" type="submit" id="confim-checkout">Xác nhận đặt hàng</button></div>

                                        </div>
                                    </form>
                                </div>
                                <div class="col-lg-6">
                                    <h1 class="checkout-f__h1">Các sản phẩm sẽ mua</h1>
                                    <div class="o-summary">
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__item-wrap gl-scroll list-cart">
                                            </div>
                                        </div>
                                     
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <table class="o-summary__table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Phí vận chuyển</td>
                                                            <td id="price-shipping"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tổng tiền sản phẩm</td>
                                                            <td id="price-product"></td>
                                                        </tr>
                                                        <tr>
                                                            <td>Tổng thanh toán</td>
                                                            <td id="price-payment"></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="o-summary__section u-s-m-b-30">
                                            <div class="o-summary__box">
                                                <h1 class="checkout-f__h1">Thông tin thanh toán</h1>
                                                    <div class="u-s-m-b-10">
                                                        <div class="radio-box">

                                                            <input type="radio" id="cash-on-delivery" name="payment" checked>
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="cash-on-delivery">Thanh toán khi nhận hàng</label></div>
                                                        </div>
                                                        <span class="gl-text u-s-m-t-6">Thanh toán tiền mặt khi nhận hàng. (Sắp xếp thời gian và chuẩn bị số tiền để nhận hàng)</span>
                                                    </div>
                                                    {{-- <div class="u-s-m-b-10">

                                                        <div class="radio-box">

                                                            <input type="radio" id="direct-bank-transfer" name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="direct-bank-transfer">Chuyển khoản trực tiếp</label></div>
                                                        </div>
                                                        <span class="gl-text u-s-m-t-6">Thực hiện thanh toán của bạn trực tiếp vào tài khoản ngân hàng của chúng tôi. Vui lòng sử dụng ID đơn đặt hàng của bạn làm tham chiếu thanh toán. Đơn đặt hàng của bạn sẽ không được giao cho đến khi số tiền trong tài khoản của chúng tôi được thanh toán.</span>
                                                    </div>
                                                    <div class="u-s-m-b-10">

                                                        <div class="radio-box">

                                                            <input type="radio" id="pay-pal" name="payment">
                                                            <div class="radio-box__state radio-box__state--primary">

                                                                <label class="radio-box__label" for="pay-pal">Pay Pal</label></div>
                                                        </div>
                                                        <span class="gl-text u-s-m-t-6">Khi bạn nhấp vào "Đặt hàng" bên dưới, chúng tôi sẽ đưa bạn đến trang web của Paypal để thiết lập thông tin thanh toán của bạn.</span>
                                                    </div> --}}
                                                    <div class="u-s-m-b-15">
                                                        <div class="check-box">

                                                            <input type="checkbox" id="term-and-condition">
                                                            <div class="check-box__state check-box__state--primary">

                                                                <label class="check-box__label" for="term-and-condition">Tôi đồng ý với</label></div>
                                                        </div>
                                                        <a class="gl-link">Điều khoản và dịch vụ.</a>
                                                    </div>
                                                    <div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



