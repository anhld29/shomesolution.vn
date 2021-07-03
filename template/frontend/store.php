<?php include('header.php') ?>
<script>
    $("body").removeAttr('class');
    $("body").attr('class', "smile-store-locator-store-search page-layout-1column loading-active-12 loading-actived");


</script>
<main id="maincontent" class="page-main">

    <a id="contentarea" tabindex="-1"></a>
    <div class="page-title-wrapper">
        <h1 class="page-title">
            <span class="base" data-ui-id="page-title-wrapper">Tìm kiếm cửa hàng</span>
        </h1>
    </div>
    <div class="page messages">
        <div data-placeholder="messages"></div>
    </div>
    <div class="columns">
        <div class="column main">
            <div id="store-locator-search-wrapper" class="store-search">
                <div class="contextual-bar">

                    <div class="shop-search">
                        <div class="fulltext-search-wrapper">
                            <div class="geocoder-wrapper">
                                <form class="form">
                                    <div class="geolocalize-container">
                                        <div class="field col-md-12 col-sm-24 col-sx-24">
                                            <p class="title-map">Chọn tỉnh thành</p>
                                            <select name="region" id="region">
                                                <option value=""> -- Thành phố / Tỉnh --</option>
                                                <option value="570">Hà Nội</option>
                                                <option value="569">Hồ Chí Minh</option>
                                                <option value="604">An Giang</option>
                                                <option value="609">Bà Rịa Vũng Tàu</option>
                                                <option value="598">Bình Dương</option>
                                                <option value="628">Bạc Liêu</option>
                                                <option value="632">Bắc Ninh</option>
                                                <option value="608">Bến Tre</option>
                                                <option value="606">Cà Mau</option>
                                                <option value="602">Cần Thơ</option>
                                                <option value="624">Hưng Yên</option>
                                                <option value="588">Hải Dương</option>
                                                <option value="574">Hải Phòng</option>
                                                <option value="605">Kiên Giang</option>
                                                <option value="596">Lâm Đồng</option>
                                                <option value="589">Ninh Bình</option>
                                                <option value="577">Phú Thọ</option>
                                                <option value="626">Quảng Nam</option>
                                                <option value="573">Quảng Ninh</option>
                                                <option value="619">Sóc Trăng</option>
                                                <option value="590">Thanh Hóa</option>
                                                <option value="578">Thái Nguyên</option>
                                                <option value="600">Tiền Giang</option>
                                                <option value="601">Vĩnh Long</option>
                                                <option value="623">Vĩnh Phúc</option>
                                                <option value="593">Đà Nẵng</option>
                                                <option value="594">Đăklak</option>
                                                <option value="597">Đồng Nai</option>
                                                <option value="603">Đồng Tháp</option>
                                            </select>
                                        </div>
                                        <div class="field col-md-12 col-sm-24 col-sx-24">
                                            <p class="title-map">Chọn quận/huyện</p>
                                            <select name="city" id="city">
                                                <option value=""> -- Quận / Huyện --</option>
                                                <option value="330">Quận 6</option>
                                                <option value="328">Quận 4</option>
                                                <option value="338">Quận Gò Vấp</option>
                                                <option value="326">Quận 2</option>
                                                <option value="339">Quận Bình Thạnh</option>
                                                <option value="329">Quận 5</option>
                                                <option value="325">Quận 1</option>
                                                <option value="341">Quận Tân Phú</option>
                                                <option value="333">Quận 9</option>
                                                <option value="335">Quận 11</option>
                                                <option value="331">Quận 7</option>
                                                <option value="334">Quận 10</option>
                                                <option value="337">Quận Thủ Đức</option>
                                                <option value="346">Huyện Bình Chánh</option>
                                            </select>
                                        </div>
                                    </div>

                                </form>
                            </div>
                        </div>

                        <div class="search-result-list list-level">
                            <div class="search-result-header">
                                <p>24 kết quả</p>
                            </div>
                            <ul>

                                <li class="result-item">
                                    <div class="heading" style="display: flex">

                                        <p class="name-label" style="flex: 1"><span>17</span>.<strong
                                                    data-bind="text: name">Vua Nệm 512 Lý Thái Tổ</strong></p>
                                    </div>
                                    <div class="details">
                                        <p class="address" style="flex:1"><em>512 Lý Thái Tổ,
                                                P.10, Quận 10, Hồ Chí Minh</em><br><em>Điện thoại : </em>
                                            <em>18002093 - Máy lẻ: 6817</em></p>

                                        <p class="button-desktop button-view">
                                            <a href="#" onclick="return false;">Tìm đường</a>
                                            <a class="arrow-right"><span><i class="fa fa-angle-right"
                                                                            aria-hidden="true"></i></span></a>
                                        </p>
                                        <p class="button-mobile button-view">
                                            <a target="_blank" class="">Tìm đường</a>
                                            <a class="arrow-right"><span><i class="fa fa-angle-right"
                                                                            aria-hidden="true"></i></span></a>
                                        </p>
                                    </div>
                                </li>


                            </ul>
                        </div>

                    </div>

                </div>
                <div class="map">

                    dấdsa
                </div>


            </div>
        </div>

    </div>
    </div></main>
<?php include('footer.php') ?>
