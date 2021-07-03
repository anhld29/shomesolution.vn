<?php include('header.php') ?>
<script>
    $("body").removeAttr('class');
    $("body").attr('class', "customer-account-login page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">
    <div data-bind="scope: 'messages'">
        <!-- ko if: cookieMessages && cookieMessages.length > 0 --><!-- /ko -->
        <!-- ko if: messages().messages && messages().messages.length > 0 --><!-- /ko -->
    </div>

    <a id="contentarea" tabindex="-1"></a>
    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Khách hàng đăng nhập</span></h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main"><input name="form_key" type="hidden" value="EemhjVvt9rj3W6zE">
            <div id="authenticationPopup" data-bind="scope:'authenticationPopup'" style="display: none;">
                <script>
                    window.authenticationPopup = {
                        "autocomplete": "off",
                        "customerRegisterUrl": "https:\/\/shomesolution.com\/customer\/account\/create\/",
                        "customerForgotPasswordUrl": "https:\/\/shomesolution.com\/customer\/account\/forgotpassword\/",
                        "baseUrl": "https:\/\/shomesolution.com\/",
                        "guestCheckoutUrl": "https:\/\/shomesolution.com\/checkout\/"
                    };
                </script>
                <!-- ko template: getTemplate() -->


                <!-- /ko -->

            </div>


            <div id="monkey_campaign" style="display:none;">
            </div>
            <script>
                window.socialAuthenticationPopup = {
                    "facebook": {
                        "label": "Facebook",
                        "login_url": "https:\/\/shomesolution.com\/sociallogin\/social\/login\/type\/facebook\/",
                        "url": "https:\/\/shomesolution.com\/sociallogin\/social\/login\/authen\/popup\/type\/facebook\/",
                        "key": "facebook",
                        "btn_key": "facebook"
                    },
                    "google": {
                        "label": "Google",
                        "login_url": "https:\/\/shomesolution.com\/sociallogin\/social\/login\/type\/google\/",
                        "url": "https:\/\/shomesolution.com\/sociallogin\/social\/login\/authen\/popup\/type\/google\/",
                        "key": "google",
                        "btn_key": "google"
                    }
                };
            </script>
            <div class="login-container">
                <div class="block block-customer-social-login">
                    <div class="block-title">
                        <strong id="block-customer-login-heading" role="heading" aria-level="2">Đăng Nhập</strong>
                        <div class="field note">Sử dụng tài khoản Facebook hoặc Google</div>
                    </div>
                    <div class="block-content" aria-labelledby="block-customer-social-login-heading">
                        <div class="actions-toolbar social-btn">
                            <a class="btn btn-block btn-social btn-facebook">
                                <span class="fa fa-facebook"></span>
                                Facebook </a>
                            <a class="btn btn-block btn-social btn-google">
                                <span class="fa fa-google"></span>
                                Google </a>
                        </div>
                    </div>
                </div>
                <div class="block block-customer-login">
                    <div class="block-title">
                        <strong id="block-customer-login-heading" role="heading" aria-level="2">Khách hàng đã đăng
                            ký</strong>
                        <div class="field note">Vui lòng đăng nhập nếu bạn đã có tài khoản</div>
                    </div>
                    <div class="block-content" aria-labelledby="block-customer-login-heading">
                        <form class="form form-login"
                              action="https://shomesolution.com/customer/account/loginPost/referer/aHR0cHM6Ly92dWFuZW0uY29tL2N1c3RvbWVyL2FjY291bnQvaW5kZXgv/"
                              method="post" id="login-form" novalidate="novalidate">
                            <input name="form_key" type="hidden" value="EemhjVvt9rj3W6zE">
                            <fieldset class="fieldset login" data-hasrequired="* Vui lòng điền thông tin bắt buộc">
                                <div class="field email required">
                                    <label class="label" for="email"><span>Email</span></label>
                                    <div class="control">
                                        <input placeholder="Email" name="login[username]" value="" autocomplete="off"
                                               id="email" type="email" class="input-text" title="Email"
                                               data-validate="{required:true, 'validate-email':true}"
                                               aria-required="true">
                                    </div>
                                </div>
                                <div class="field password required">
                                    <label for="pass" class="label"><span>Mật khẩu</span></label>
                                    <div class="control">
                                        <input placeholder="Password" name="login[password]" type="password"
                                               autocomplete="off" class="input-text" id="pass" title="Mật khẩu"
                                               data-validate="{required:true, 'validate-password':true}"
                                               aria-required="true">
                                    </div>
                                </div>
                                <div class="actions-toolbar">
                                    <div class="primary">
                                        <button type="submit" class="action login primary" name="send" id="send2"><span>Đăng nhập</span>
                                        </button>
                                    </div>
                                    <div class="secondary"><a class="action remind"
                                                              href="https://shomesolution.com/customer/account/forgotpassword/"><span>Bạn quên mật khẩu?</span></a>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                <div class="block block-new-customer">
                    <div class="block-title">
                        <strong id="block-new-customer-heading" role="heading" aria-level="2">Khách hàng mới</strong>
                    </div>
                    <div class="block-content" aria-labelledby="block-new-customer-heading">
                        <p>Tạo tài khoản có nhiều lợi ích: kiểm tra nhanh hơn, giữ nhiều hơn một địa chỉ, theo dõi các
                            đơn đặt hàng và nhiều hơn nữa.</p>
                        <div class="actions-toolbar">
                            <div class="primary">
                                <a href="https://shomesolution.com/customer/account/create/"
                                   class="action create primary"><span>Tạo tài khoản</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
<?php include('footer.php') ?>
