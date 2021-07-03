<?php include('header.php') ?>
<script>
    $("body").removeAttr('class');
    $("body").attr('class', "account customer-address-form page-layout-2columns-left loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">
    <div data-bind="scope: 'messages'">
        <!-- ko if: cookieMessages && cookieMessages.length > 0 --><!-- /ko -->
        <!-- ko if: messages().messages && messages().messages.length > 0 --><!-- /ko -->
    </div>

    <a id="contentarea" tabindex="-1"></a>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">
            <div class="page-title-wrapper">
                <h1 class="page-title">
                    <span class="base" data-ui-id="page-title-wrapper">Thêm địa chỉ mới</span></h1>
            </div>
            <input name="form_key" type="hidden" value="BxKHgDRS9OkFI1Wc">
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
            <form class="form-address-edit" action="https://shomesolution.com/customer/address/formPost/" method="post"
                  id="form-validate" enctype="multipart/form-data" data-hasrequired="* Vui lòng điền thông tin bắt buộc"
                  novalidate="novalidate">
                <fieldset class="fieldset">
                    <legend class="legend"><span>Thông tin liên hệ</span></legend>
                    <br>
                    <input name="form_key" type="hidden" value="BxKHgDRS9OkFI1Wc"> <input type="hidden"
                                                                                          name="success_url" value="">
                    <input type="hidden" name="error_url" value="">
                    <div class="field field-name-lastname required">
                        <label class="label" for="lastname">
                            <span>Họ</span>
                        </label>
                        <div class="control">
                            <input placeholder="Họ" type="text" id="lastname" name="lastname" value="nguyễn"
                                   title="Họ" class="input-text required-entry" data-validate="{required:true}"
                                   aria-required="true">
                        </div>
                    </div>
                    <div class="field field-name-firstname required">
                        <label class="label" for="firstname">
                            <span>Tên</span>
                        </label>
                        <div class="control">
                            <input placeholder="Tên" type="text" id="firstname" name="firstname" value="quyền"
                                   title="Tên" class="input-text required-entry" data-validate="{required:true}"
                                   aria-required="true">
                        </div>
                    </div>
                    <div class="field company ">
                        <label for="company" class="label">
<span>
Công ty </span>
                        </label>
                        <div class="control">
                            <input type="text" name="company" id="company" value="" title="Công ty" class="input-text ">
                        </div>
                    </div>
                    <div class="field telephone required">
                        <label for="telephone" class="label">
<span>
Số Điện thoại </span>
                        </label>
                        <div class="control">
                            <input type="text" name="telephone" id="telephone" value="" title="Số Điện thoại"
                                   class="input-text required-entry" aria-required="true">
                        </div>
                    </div>
                </fieldset>
                <fieldset class="fieldset">
                    <legend class="legend"><span>Địa chỉ</span></legend>
                    <br>
                    <div class="field region required">
                        <label class="label" for="region_id">
                            <span>Tỉnh/Thành phố</span>
                        </label>
                        <div class="control">
                            <select id="region_id" name="region_id" title="Tỉnh/Thành phố"
                                    class="validate-select required-entry" aria-required="true" defaultvalue="0"
                                    style="display: inline-block;">
                                <option value="">Chọn Tỉnh/Thành phố</option>
                                <option value="569">Hồ Chí Minh</option>
                                <option value="570">Hà Nội</option>
                                <option value="571">Cao Bằng</option>
                                <option value="572">Lạng Sơn</option>
                                <option value="573">Quảng Ninh</option>
                                <option value="574">Hải Phòng</option>
                                <option value="575">Thái Bình</option>
                                <option value="576">Nam Định</option>
                                <option value="577">Phú Thọ</option>
                                <option value="578">Thái Nguyên</option>
                                <option value="579">Yên Bái</option>
                                <option value="580">Tuyên Quang</option>
                                <option value="581">Hà Giang</option>
                                <option value="582">Lào Cai</option>
                                <option value="583">Lai Châu</option>
                                <option value="584">Sơn La</option>
                                <option value="585">Điện Biên</option>
                                <option value="586">Hòa Bình</option>
                                <option value="587">Hà Tây</option>
                                <option value="588">Hải Dương</option>
                                <option value="589">Ninh Bình</option>
                                <option value="590">Thanh Hóa</option>
                                <option value="591">Nghệ An</option>
                                <option value="592">Hà Tĩnh</option>
                                <option value="593">Đà Nẵng</option>
                                <option value="594">Đăklak</option>
                                <option value="595">Đắk Nông</option>
                                <option value="596">Lâm Đồng</option>
                                <option value="597">Đồng Nai</option>
                                <option value="598">Bình Dương</option>
                                <option value="599">Long An</option>
                                <option value="600">Tiền Giang</option>
                                <option value="601">Vĩnh Long</option>
                                <option value="602">Cần Thơ</option>
                                <option value="603">Đồng Tháp</option>
                                <option value="604">An Giang</option>
                                <option value="605">Kiên Giang</option>
                                <option value="606">Cà Mau</option>
                                <option value="607">Tây Ninh</option>
                                <option value="608">Bến Tre</option>
                                <option value="609">Bà Rịa Vũng Tàu</option>
                                <option value="610">Quảng Bình</option>
                                <option value="611">Quảng Trị</option>
                                <option value="612">Thừa Thiên Huế</option>
                                <option value="613">Quảng Ngãi</option>
                                <option value="614">Bình Định</option>
                                <option value="615">Phú Yên</option>
                                <option value="616">Khánh Hòa</option>
                                <option value="617">Gia Lai</option>
                                <option value="618">KonTum</option>
                                <option value="619">Sóc Trăng</option>
                                <option value="620">Trà Vinh</option>
                                <option value="621">Ninh Thuận</option>
                                <option value="622">Bình Thuận</option>
                                <option value="623">Vĩnh Phúc</option>
                                <option value="624">Hưng Yên</option>
                                <option value="625">Hà Nam</option>
                                <option value="626">Quảng Nam</option>
                                <option value="627">Bình Phước</option>
                                <option value="628">Bạc Liêu</option>
                                <option value="629">Hậu Giang</option>
                                <option value="630">Bắc Kạn</option>
                                <option value="631">Bắc Giang</option>
                                <option value="632">Bắc Ninh</option>
                            </select>
                            <input type="text" id="region" name="region" value="" title="Tỉnh/Thành phố"
                                   class="input-text" aria-required="true" style="display: none;">
                        </div>
                    </div>
                    <div class="field city required">
                        <label class="label" for="city"><span>Quận/Huyện</span></label>
                        <div class="control">
                            <select id="city_id" name="city_id" title="Quận/Huyện" class="validate-select"
                                    aria-required="true" disabled="" defaultvalue="0" style="display: none;">
                                <option value="">Chọn Quận/Huyện</option>
                            </select>
                            <input type="text" name="city" value="" title="Quận/Huyện" class="input-text required-entry"
                                   id="city" aria-required="true">
                        </div>
                    </div>
                    <div class="field street required">
                        <label for="street_1" class="label">
                            <span>Địa chỉ đường</span>
                        </label>
                        <div class="control">
                            <input type="text" name="street[]" value="" title="Địa chỉ đường" id="street_1"
                                   class="input-text required-entry" aria-required="true">
                            <div class="nested">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="postcode" value="" title="Mã bưu chính" id="zip">
                    <div class="field country required">
                        <label class="label" for="country"><span>Nước</span></label>
                        <div class="control">
                            <select name="country_id" id="country" class="required-entry" title="Nước"
                                    data-validate="{'validate-select':true}" aria-required="true">
                                <option value=""></option>
                                <option value="VN" selected="selected">Việt Nam</option>
                            </select></div>
                    </div>
                    <input type="hidden" name="default_billing" value="1">
                    <input type="hidden" name="default_shipping" value="1">
                </fieldset>
                <div class="actions-toolbar">
                    <div class="primary">
                        <button type="submit" class="action save primary" data-action="save-address"
                                title="Lưu địa chỉ">
                            <span>Lưu địa chỉ</span>
                        </button>
                    </div>
                    <div class="secondary">
                        <a class="action back" href="https://shomesolution.com/customer/account/">
                            <span>Quay lại</span>
                        </a>
                    </div>
                </div>
            </form>

        </div>
        <div class="sidebar sidebar-main">
            <div class="block block-collapsible-nav">
                <div class="title block-collapsible-nav-title">
                    <strong>Tổng quan tài khoản</strong>
                </div>
                <div class="content block-collapsible-nav-content" id="block-collapsible-nav">
                    <ul class="nav items">
                        <li class="nav item"><a href="https://shomesolution.com/customer/account/">Tổng quan tài khoản</a></li>
                        <li class="nav item current"><a href="https://shomesolution.com/customer/address/"><strong>Sổ địa
                                    chỉ</strong></a></li>
                        <li class="nav item"><a href="https://shomesolution.com/customer/account/edit/">Thông tin tài
                                khoản</a></li>
                        <li class="nav item"><a href="https://shomesolution.com/review/customer/">Đánh giá sản phẩm của tôi</a>
                        </li>
                        <li class="nav item"><a href="https://shomesolution.com/sales/order/history/">Đơn đặt hàng của tôi</a>
                        </li>
                        <li class="nav item"><a href="https://shomesolution.com/newsletter/manage/">Đăng ký nhận bản tin</a>
                        </li>
                        <li class="nav item"><a href="https://shomesolution.com/wishlist/">Danh sách yêu thích của tôi</a></li>
                    </ul>
                </div>
            </div>
            <div class="block account-nav">
                <div class="title account-nav-title">
                    <strong></strong>
                </div>
                <div class="content account-nav-content" id="account-nav">
                </div>
            </div>
        </div>
        
    </div>
</main>
<?php include('footer.php') ?>
