<div class="section__content">
    <div class="container">
        <div class="row row--center">
            <div class="col-md-12">
                <div class="l-f-o">
                    <div class="l-f-o__pad-box">

                        <div class="u-s-m-b-15">
                            <a class="l-f-o__create-link btn--e-transparent-brand-b-2" id="createAccount">Tạo tài khoản mới</a></div>
                        <h1 class="gl-h1">Đăng nhập</h1>

                        <span class="gl-text u-s-m-b-30">Nếu bạn có một tài khoản với chúng tôi, xin vui lòng đăng nhập.</span>
                        <form id="loginCustomer" class="l-f-o__form">
                            <div class="gl-s-api">
                                <div class="u-s-m-b-15">

                                    <button class="gl-s-api__btn gl-s-api__btn--fb" type="button"><i class="fab fa-facebook-f"></i>

                                        <span>Đăng nhập bằng Facebook</span></button></div>
                                <div class="u-s-m-b-15">

                                    <button class="gl-s-api__btn gl-s-api__btn--gplus" type="button"><i class="fab fa-google"></i>

                                        <span>Đăng nhập bằng Google</span></button></div>
                            </div>
                            <div class="u-s-m-b-30">

                                <label class="gl-label" for="login-email">Tài khoản*</label>

                                <input class="input-text input-text--primary-style" name="email" type="text" id="loginEmail" placeholder="Nhập tài khoản">
                                <div id="emailLoginError" class="form-text text-danger"></div>
                            </div>
                              
                            <div class="u-s-m-b-30">

                                <label class="gl-label" for="login-password">Mật khẩu *</label>

                                <input class="input-text input-text--primary-style" name="password" type="password" id="loginPassword" placeholder="Nhập mật khẩu">
                                <div id="passwordLoginError" class="form-text text-danger"></div>
                            </div>
                            <div class="gl-inline">
                                <div class="u-s-m-b-30">

                                    <button class="btn btn--e-transparent-brand-b-2" id="confirmLogin" type="submit">Đăng nhập</button></div>
                                <div class="u-s-m-b-30">

                                    <a class="gl-link" id="reset-password">Quên mật khẩu?</a></div>
                            </div>
                            <div class="u-s-m-b-30">

                                <!--====== Check Box ======-->
                                <div class="check-box">

                                    <input type="checkbox" id="remember-me">
                                    <div class="check-box__state check-box__state--primary">

                                        <label class="check-box__label" for="remember-me">Nhớ tài khoản</label></div>
                                </div>
                                <!--====== End - Check Box ======-->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>