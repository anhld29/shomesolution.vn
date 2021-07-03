<?php include('header.php') ?>
<script>
    $("body").removeAttr('class');
    $("body").attr('class', "customer-account-create page-layout-1column add-padding-header iMenu loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">
    <div data-bind="scope: 'messages'">
        <!-- ko if: cookieMessages && cookieMessages.length > 0 --><!-- /ko -->
        <!-- ko if: messages().messages && messages().messages.length > 0 --><!-- /ko -->
    </div>

    <a id="contentarea" tabindex="-1"></a>
    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Tạo mới tài khoản khách hàng</span></h1>
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
            <div class="block block-customer-social-login">
                <div class="block-title">
                    <strong id="block-customer-login-heading" role="heading" aria-level="2">Đăng Nhập</strong>
                    <div class="field note">Sử dụng tài khoản Facebook hoặc Google</div>
                </div>
                <div class="block-content block-customer-create" aria-labelledby="block-customer-social-login-heading">
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
            <div id="register-form-now">
                <div class="block block-register-account">
                    <div class="block-title">
                        <strong id="block-customer-login-heading">
                            HOẶC TẠO TÀI KHOẢN </strong>
                        <div class="field note">
                            Vui lòng điền thông tin phía dưới
                        </div>
                    </div>
                    <form class="form create account form-create-account"
                          action="https://shomesolution.com/customer/account/createpost/" method="post" id="form-validate"
                          enctype="multipart/form-data" autocomplete="off" novalidate="novalidate">
                        <input name="form_key" type="hidden" value="EemhjVvt9rj3W6zE">
                        <div class="block-content-register">
                            <fieldset class="fieldset create info">
                                <legend class="legend"><span>Thông tin cá nhân</span></legend>
                                <br>
                                <div class="field field-name-lastname required">
                                    <label class="label" for="lastname">
                                        <span>Họ</span>
                                    </label>
                                    <div class="control">
                                        <input placeholder="Họ" type="text" id="lastname" name="lastname" value=""
                                               title="Họ" class="input-text required-entry"
                                               data-validate="{required:true}" autocomplete="off" aria-required="true">
                                    </div>
                                </div>
                                <div class="field field-name-firstname required">
                                    <label class="label" for="firstname">
                                        <span>Tên</span>
                                    </label>
                                    <div class="control">
                                        <input placeholder="Tên" type="text" id="firstname" name="firstname" value=""
                                               title="Tên" class="input-text required-entry"
                                               data-validate="{required:true}" autocomplete="off" aria-required="true">
                                    </div>
                                </div>
                                <div class="field required">
                                    <label for="email_address" class="label"><span>Email</span></label>
                                    <div class="control">
                                        <input type="email" placeholder="Email" name="email" id="email_address" value=""
                                               title="Email" class="input-text"
                                               data-validate="{required:true, 'validate-email':true}"
                                               aria-required="true">
                                    </div>
                                </div>

                            </fieldset>
                            <fieldset class="fieldset create account"
                                      data-hasrequired="* Vui lòng điền thông tin bắt buộc">
                                <legend class="legend"><span>Thông tin đăng nhập</span></legend>
                                <br>
                                <div class="field field-name-lastname required">
                                    <label class="label" for="lastname">
                                        <span>Họ</span>
                                    </label>
                                    <div class="control">
                                        <input placeholder="Họ" type="text" id="lastname" name="lastname" value=""
                                               title="Họ" class="input-text required-entry"
                                               data-validate="{required:true}" autocomplete="off" aria-required="true">
                                    </div>
                                </div>
                                <div class="field field-name-lastname required">
                                    <label class="label" for="lastname">
                                        <span>Họ</span>
                                    </label>
                                    <div class="control">
                                        <input placeholder="Họ" type="text" id="lastname" name="lastname" value=""
                                               title="Họ" class="input-text required-entry"
                                               data-validate="{required:true}" autocomplete="off" aria-required="true">
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="actions-toolbar">
                            <div class="primary">
                                <button type="submit" class="action submit primary" title="Tạo tài khoản"><span>Tạo tài khoản</span>
                                </button>
                            </div>
                            <div class="secondary">
                                <a class="action back"
                                   href="https://shomesolution.com/customer/account/login/referer/aHR0cHM6Ly92dWFuZW0uY29tL2N1c3RvbWVyL2FjY291bnQvY3JlYXRlLw%2C%2C/"><span>Quay lại</span></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <script>
                require([
                    'jquery',
                    'mage/mage'
                ], function ($) {

                    var dataForm = $('#form-validate');
                    var ignore = null;

                    dataForm.mage('validation', {
                        ignore: ignore ? ':hidden:not(' + ignore + ')' : ':hidden'
                    }).find('input:text').attr('autocomplete', 'off');

                });
            </script>

        </div>
    </div>
</main>
<?php include('footer.php') ?>
