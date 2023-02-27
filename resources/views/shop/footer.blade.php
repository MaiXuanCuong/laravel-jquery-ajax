<footer>
    <div class="outer-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="outer-footer__content u-s-m-b-40">

                        <span class="outer-footer__content-title">Liên hệ chúng tôi</span>
                        <div class="outer-footer__text-wrap"><i class="fas fa-home"></i>

                            <span>Vĩnh An - Cam Hiếu - Cam Lộ - Quảng Trị</span></div>
                        <div class="outer-footer__text-wrap"><i class="fas fa-phone-volume"></i>

                            <a href="tel:+84843442357"><span>0843442357</span></a></div>
                        <div class="outer-footer__text-wrap"><i class="far fa-envelope"></i>

                           <a href="mailto:maixuancuong2906@gmail.com"><span>maixuancuong2906@gmail.com</span></a></div>
                        <div class="outer-footer__social">
                            <ul>
                                <li>

                                    <a class="s-fb--color-hover" href="#"><i class="fab fa-facebook-f"></i></a></li>
                                <li>

                                    <a class="s-tw--color-hover" href="#"><i class="fab fa-twitter"></i></a></li>
                                <li>

                                    <a class="s-youtube--color-hover" href="#"><i class="fab fa-youtube"></i></a></li>
                                <li>

                                    <a class="s-insta--color-hover" href="#"><i class="fab fa-instagram"></i></a></li>
                                <li>

                                    <a class="s-gplus--color-hover" href="#"><i class="fab fa-google-plus-g"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="outer-footer__content u-s-m-b-40">

                                <span class="outer-footer__content-title">Thông tin</span>
                                <div class="outer-footer__list-wrap">
                                    <ul>
                                        <li>

                                            <a href="{{ asset('shop/cart.html') }}">Giỏ hàng</a></li>
                                        <li>

                                            <a href="{{ asset('shop/dashboard.html') }}">Tài khoản</a></li>
                                        <li>

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">Tác giả</a></li>
                                        <li>

                                            <a href="{{ asset('shop/dash-payment-option.html') }}">Tài chính</a></li>
                                        <li>

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">Cửa hàng</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="outer-footer__content u-s-m-b-40">
                                <div class="outer-footer__list-wrap">

                                    <span class="outer-footer__content-title">Công ty</span>
                                    <ul>
                                        <li>

                                            <a href="{{ asset('shop/about.html') }}">Về chúng tôi</a></li>
                                        <li>

                                            <a href="{{ asset('shop/contact.html') }}">Liên hệ</a></li>
                                        <li>

                                            <a href="{{ asset('shop/index-3.html') }}">Sơ đồ</a></li>
                                        <li>

                                            <a href="{{ asset('shop/dash-my-order.html') }}">Vận chuyển</a></li>
                                        <li>

                                            <a href="{{ asset('shop/shop-side-version-2.html') }}">Kho</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-12">
                    <div class="outer-footer__content">

                        <span class="outer-footer__content-title">Tham gia bản tin của chúng tôi</span>
                        <form class="newsletter">
                            <div class="u-s-m-b-15">
                                <div class="radio-box newsletter__radio">

                                    <input type="radio" id="male" name="gender">
                                    <div class="radio-box__state radio-box__state--primary">

                                        <label class="radio-box__label" for="male">Nam</label></div>
                                </div>
                                <div class="radio-box newsletter__radio">

                                    <input type="radio" id="female" name="gender">
                                    <div class="radio-box__state radio-box__state--primary">

                                        <label class="radio-box__label" for="female">Nữ</label></div>
                                </div>
                            </div>
                            <div class="newsletter__group">

                                <label for="newsletter"></label>

                                <input class="input-text input-text--only-white" type="text" id="newsletter" placeholder="Nhập email">

                                <button class="btn btn--e-brand newsletter__btn" type="submit">Đăng ký</button></div>

                            <span class="newsletter__text">Theo dõi danh sách gửi thư để nhận thông tin cập nhật về các chương trình khuyến mãi, hàng mới, giảm giá và phiếu giảm giá.</span>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="lower-footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="lower-footer__content">
                        <div class="lower-footer__copyright">

                            <span>Bản quyền ©<b id="hvn"></b></span>
                            <span>Đã đăng ký bản quyền.</span></div>
                        <div class="lower-footer__payment">
                            <ul>
                                <li><i class="fab fa-cc-stripe"></i></li>
                                <li><i class="fab fa-cc-paypal"></i></li>
                                <li><i class="fab fa-cc-mastercard"></i></li>
                                <li><i class="fab fa-cc-visa"></i></li>
                                <li><i class="fab fa-cc-discover"></i></li>
                                <li><i class="fab fa-cc-amex"></i></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<script>
    var today = new Date();
    var time = today.getFullYear();
    document.getElementById("hvn").innerHTML = time;
   </script>
   <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.0/dist/js.cookie.min.js"></script>