<?php include('header.php') ?>
<script>
    $("body").removeAttr('class');
    $("body").attr('class', "account customer-account-index page-layout-2columns-left loading-active-12 loading-actived");


</script>

<main id="maincontent" class="page-main">


    <a id="contentarea" tabindex="-1"></a>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">
            <div class="page-title-wrapper">
                <h1 class="page-title"><span class="base" data-ui-id="page-title-wrapper">Tài khoản của tôi</span></h1>
            </div>

            <div class="block block-dashboard-info">
                <div class="block-title"><strong>Thông tin tài khoản</strong></div>
                <div class="block-content">
                    <div class="box box-information">
                        <strong class="box-title">
                            <span>Thông tin liên hệ</span>
                        </strong>
                        <div class="box-content">
                            <p>
                                quyền nguyễn<br>
                                nguyenquyen571995@gmail.com<br>
                            </p>
                        </div>
                        <div class="box-actions">
                            <a class="action edit" href="https://shomesolution.com/customer/account/edit/">
                                <span>Chỉnh sửa</span>
                            </a>
                            <a href="https://shomesolution.com/customer/account/edit/changepass/1/"
                               class="action change-password">
                                Đổi mật khẩu </a>
                        </div>
                    </div>
                    <div class="box box-newsletter">
                        <strong class="box-title">
                            <span>Bản tin</span>
                        </strong>
                        <div class="box-content">
                            <p>
                                Bạn chưa đăng ký nhận bản tin từ Vua Nệm. </p>
                        </div>
                        <div class="box-actions">
                            <a class="action edit" href="https://shomesolution.com/newsletter/manage/"><span>Chỉnh sửa</span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="block block-dashboard-addresses">
                <div class="block-title">
                    <strong>Sổ địa chỉ</strong>
                    <a class="action edit" href="https://shomesolution.com/customer/address/"><span>Quản lý địa chỉ</span></a>
                </div>
                <div class="block-content">
                    <div class="box box-billing-address">
                        <strong class="box-title">
                            <span>Địa chỉ thanh toán mặc định</span>
                        </strong>
                        <div class="box-content">
                            <address>
                                Bạn chưa thiết lập địa chỉ vận chuyển mặc định.
                            </address>
                        </div>
                        <div class="box-actions">
                            <a class="action edit" href="https://shomesolution.com/customer/address/edit/"
                               data-ui-id="default-billing-edit-link"><span>Sửa địa chỉ</span></a>
                        </div>
                    </div>
                    <div class="box box-shipping-address">
                        <strong class="box-title">
                            <span>Địa chỉ giao hàng mặc định</span>
                        </strong>
                        <div class="box-content">
                            <address>
                                Bạn chưa thiết lập địa chỉ vận chuyển mặc định.
                            </address>
                        </div>
                        <div class="box-actions">
                            <a class="action edit" href="https://shomesolution.com/customer/address/edit/"
                               data-ui-id="default-shipping-edit-link"><span>Sửa địa chỉ</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="sidebar sidebar-main">
            <div class="block block-collapsible-nav">
                <div class="title block-collapsible-nav-title">
                    <strong>Tổng quan tài khoản</strong>
                </div>
                <div class="content block-collapsible-nav-content" id="block-collapsible-nav">
                    <ul class="nav items">
                        <li class="nav item current"><strong>Tổng quan tài khoản</strong></li>
                        <li class="nav item"><a href="https://shomesolution.com/customer/address/">Sổ địa chỉ</a></li>
                        <li class="nav item"><a href="https://shomesolution.com/customer/account/edit/">Thông tin tài khoản</a></li>
                        <li class="nav item"><a href="https://shomesolution.com/review/customer/">Đánh giá sản phẩm của tôi</a></li>
                        <li class="nav item"><a href="https://shomesolution.com/sales/order/history/">Đơn đặt hàng của tôi</a></li>

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
