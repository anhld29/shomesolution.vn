<div id="js_prd_info" data-info="<?php echo $data_info ?>"
     data-price="<?php echo $productDetail['price'] ?>"
     data-price_sale="<?php echo $productDetail['price_sale'] ?>"
     data-price_contact="<?php echo $productDetail['price_contact'] ?>"
     data-id="<?php echo $productDetail['id'] ?>"
     data-name="<?php echo $productDetail['title'] ?>"
     data-redirect="true">

</div>
<div id="quantity" data-quantity="1"></div>
<?php
$prd_title = $productDetail['title'];
$prd_code = $productDetail['code'];
$prd_info = getPriceFrontend(array('productDetail' => $productDetail));

$prd_href = rewrite_url($productDetail['canonical']);
$comment = comment(array('id' => $productDetail['id'], 'module' => 'product'));
$prd_rate = '';
if (isset($comment) && is_array($comment) && count($comment)) {
    $prd_rate = round($comment['statisticalRating']['averagePoint']);
}

$list_image = json_decode(base64_decode($productDetail['image_json']), TRUE);
?>
<div id="main" class="wrapper main-product-detail">

    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <?php foreach ($breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], true, true);
                    ?>
                    <li><a href="<?php echo $href ?>"> / <?php echo $title ?></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
    <div class="container">
        <div class="content-product-detail">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="list-img">
                        <?php if (isset($list_image) && is_array($list_image) && count($list_image)) { ?>
                            <div class="slider-large1 owl-carousel">
                                <?php foreach ($list_image as $key => $val) { ?>
                                    <div class="item" data-hash="one<?php echo $key ?>">
                                        <img src="<?php echo $val; ?>" alt="<?php echo $productDetail['title']; ?>" style="height: 345px;object-fit: cover">
                                    </div>
                                <?php } ?>
                            </div>

                            <div class="slider-small1 owl-carousel">
                                <?php foreach ($list_image as $key => $val) { ?>

                                    <a href="<?php echo $prd_href ?>#one<?php echo $key ?>">
                                        <img src="<?php echo $val; ?>" alt="<?php echo $productDetail['title']; ?>" style="height: 100px;object-fit: cover">
                                    </a>
                                <?php } ?>

                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="product-detail-right filter-product">
                        <p class="conhang"><?php if ($productDetail['isaside'] == 0) { ?>Còn hàng<?php } else { ?>Hết hàng<?php } ?></p>
                        <h3 class="title"><?php echo $productDetail['title']; ?></h3>
                        <p class="price">Giá: <span><?php echo $prd_info['price_final'] ?></span></p>
                        <div class="list-content">
                            <?php echo $productDetail['description']; ?>
                        </div>
                        <div class="list-content2 nav-filter-product">
                            <div class="row item2">
                                <?php
                                $json = [];
                                $json[] = array('attribute', 'attribute.id = attribute_relationship.attrid', 'full');
                                $json[] = array('attribute_catalogue', 'attribute_catalogue.id = attribute.catalogueid', 'full');

                                $listColor = $this->Autoload_Model->_get_where(array(
                                    'select' => 'attribute.color,attribute.title,attribute.id',
                                    'table' => 'attribute_relationship',
                                    'where' => array('moduleid' => $productDetail['id'], 'attribute_catalogue.issearch' => 1, 'module' => 'product'),
                                    'join' => $json,
                                    'order_by' => 'attribute.order asc, attribute.id desc'), true);

                                $listDoCan = $this->Autoload_Model->_get_where(array(
                                    'select' => 'attribute.color,attribute.title,attribute.id',
                                    'table' => 'attribute_relationship',
                                    'where' => array('moduleid' => $productDetail['id'], 'attribute_catalogue.id' => 30, 'module' => 'product'),
                                    'join' => $json,
                                    'order_by' => 'attribute.order asc, attribute.id desc'), true);

                                /* $listMatTrai = $this->Autoload_Model->_get_where(array(
                                    'select' => 'attribute.color,attribute.title,attribute.id',
                                    'table' => 'attribute_relationship',
                                    'where' => array('moduleid' => $productDetail['id'], 'attribute_catalogue.id' => 34, 'module' => 'product'),
                                    'join' => $json,
                                    'order_by' => 'attribute.order asc, attribute.id desc'), true);*/

                                ?>
                                <div class="col-md-12 "><div class="errorDetails"></div> </div>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php if(!empty($listDoCan) ){?>

                                    <div class="item">
                                        <label for="" class="label">Chọn độ cận</label>
                                        <?php if (isset($listDoCan) && is_array($listDoCan) && count($listDoCan)) { ?>
                                            <select name="js_mattrai" class="js_mattrai">
                                                <option value="">Chọn</option>
                                                <?php foreach ($listDoCan as $key=>$val){?>
                                                    <option value="<?php echo $val['title']?>"><?php echo $val['title']?></option>
                                                <?php }?>
                                            </select>

                                        <?php }?>
                                        <?php /* if (isset($listMatPhai) && is_array($listMatPhai) && count($listMatPhai)) { ?>
                                            <select name="js_matphai" class="js_matphai">
                                                <option value="">Mắt phải</option>
                                                <?php foreach ($listMatPhai as $key=>$val){?>
                                                    <option value="<?php echo $val['title']?>"><?php echo $val['title']?></option>
                                                <?php }?>
                                            </select>
                                        <?php }*/?>
                                    </div>
                                    <?php }?>
                                    <div class="item">
                                        <label class="label">Chọn Số lượng</label>
                                        <select name="quantity" class="js_quantity_customer">
                                            <?php for ($i = 1; $i <= 100; $i++) { ?>
                                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
                                            <?php } ?>
                                        </select>

                                    </div>
                                </div>
                                <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>

                                <div class="col-md-12 col-sm-12 col-xs-12">
                                    <?php /*<div class="item">
                                        <label for="" class="label">Chọn màu</label>
                                        <div class="nav-checkbox">
                                            <?php foreach ($listColor as $keyC => $valC) { ?>
                                                <div class="checkbox">
                                                    <input name="color" type="checkbox"
                                                           id="a<?php echo $valC['id'] ?>" value="<?php echo $valC['title'] ?>"
                                                           <?php if ($keyC == 0){ ?>checked<?php } ?>>
                                                    <label for="a<?php echo $valC['id'] ?>"
                                                           style="background-color: <?php echo $valC['color'] ?>;border-color: <?php echo $valC['color'] ?>;"></label>
                                                    <span class="hidden"><?php echo $valC['title'] ?></span>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>*/?>
                                    <div class="item addto-cart">
                                        <a class="cartadd"
                                           data-quantity="1"
                                           data-color=""
                                           data-mattrai=""
                                           data-matphai=""
                                           data-color-check="false"
                                           data-mattrai-check="false"
                                           data-matphai-check="false"
                                           data-redirect="false"
                                           data-id="<?php echo $productDetail['id']?>" href="javascript:void(0)"  style="background: transparent;border: 1px solid #000;color: #000">Thêm vào giỏ</a>
                                    </div>

                                </div>
                                <?php }?>
                            </div>
                            <div class="muahang">
                                <a class="cartadd"
                                   data-quantity="1"
                                   data-color=""
                                   data-mattrai=""
                                   data-matphai=""
                                   data-color-check="false"
                                   data-mattrai-check="false"
                                   data-matphai-check="false"
                                   data-redirect="true"
                                   data-id="<?php echo $productDetail['id']?>" href="javascript:void(0)"  >Mua hàng</a>
                            </div>
                            <?php if (isset($listDoCan) && is_array($listDoCan) && count($listDoCan)) { ?>

                                <script>
                                    $('.cartadd').attr('data-mattrai-check','true')
                                </script>
                            <?php }?>
                            <?php if (isset($listMatPhai) && is_array($listMatPhai) && count($listMatPhai)) { ?>

                                <script>
                                    $('.cartadd').attr('data-matphai-check','true')
                                </script>
                            <?php }?>
                            <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>

                                <script>
                                    $('.cartadd').attr('data-color-check','true');
                                </script>
                            <?php }?>

                            <script>
                                $('.js_mattrai').change(function () {
                                    var value = $(this).val();
                                    $('.cartadd').attr('data-mattrai',value)
                                });
                                $('.js_matphai').change(function () {
                                    var value = $(this).val();
                                    $('.cartadd').attr('data-matphai',value)
                                });
                                $('.js_quantity_customer').change(function () {
                                    var value = $(this).val();
                                    $('.cartadd').attr('data-quantity',value)
                                });
                                $(document).on('click', 'input[type="checkbox"]', function () {
                                    $('input[type="checkbox"]').not(this).prop('checked', false);
                                    var value = $(this).prop('checked', true).val();
                                    $('.cartadd').attr('data-color',value)
                                });
                                $('input[name="color"]:checked').each(function (key, index) {
                                    let value = $(this).val();
                                    $('.cartadd').attr('data-color',value)

                                });
                            </script>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="information-detail-product">
        <div class="container">
            <div class="content-information-detail-product">
                <div class="list-detail">
                    <nav class="navigation" id="mainNav">
                        <ul>
                            <?php if (isset($extend_description['title']) && is_array($extend_description['title']) && count($extend_description['title'])) { ?>
                                <?php $i = 0;
                                foreach ($extend_description['title'] as $keyT => $valT) {
                                    $i++; ?>
                                    <li>
                                        <a class="navigation__link <?php if ($i == 1) { ?>active<?php } ?>"
                                           href="#<?php echo slug($keyT + 1) ?>"><?php echo $valT; ?></a>
                                    </li>
                                <?php } ?>
                            <?php } ?>
                            <li>
                                <a class="navigation__link" href="#3">Bình luận</a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="content-list-detail ">
                    <?php if (isset($extend_description['description']) && is_array($extend_description['description']) && count($extend_description['description'])) { ?>
                        <?php foreach ($extend_description['description'] as $keyD => $valD) { ?>
                            <div class="item-content page-section" id="1">
                                <h3 class="title">Thông tin chi tiết </h3>
                                <?php echo $valD; ?>
                            </div>
                        <?php } ?>
                    <?php } ?>
                    <div class="item-content page-section" id="3">
                        <h3 class="title">Bình luận</h3>
                        <div style="clear: both;height: 20px;"></div>
                        <div style="margin: 0px -8px">
                            <div class="fb-comments" data-href="<?php echo $canonical ?>" data-numposts="20"
                                 data-width="1000"></div>
                        </div>

                    </div>
                </div>

            </div>


        </div>

    </div>

    <?php if (isset($relaList) && is_array($relaList) && count($relaList)) { ?>

        <div class="other-poduct">
            <div class="container">
                <h3 class="other-title">Sản phẩm tương tự</h3>
                <div class="other-product owl-carousel">
                    <?php foreach ($relaList as $key => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], TRUE, TRUE);
                        $image = $val['image'];
                        $getPrice = getPriceFrontend(array('productDetail' => $val));

                        $json = [];
                        $json[] = array('attribute', 'attribute.id = attribute_relationship.attrid', 'full');
                        $json[] = array('attribute_catalogue', 'attribute_catalogue.id = attribute.catalogueid', 'full');
                        $listColor = $this->Autoload_Model->_get_where(array(
                            'select' => 'attribute.color',
                            'table' => 'attribute_relationship',
                            'where' => array('moduleid' => $val['id'], 'attribute_catalogue.issearch' => 1, 'module' => 'product'),
                            'join' => $json,
                            'order_by' => 'attribute.order asc, attribute.id desc'), true);
                        ?>
                        <div class="item22">
                            <div class="item-large">
                                <div class="item1">
                                    <div class="slider-large ">
                                        <div class="item" data-hash="one2">
                                            <a href="<?php echo $href ?>"><img src="<?php echo $val['image'] ?>"
                                                                               alt="<?php echo $val['title'] ?>"></a>
                                        </div>
                                    </div>
                                    <?php if (isset($listColor) && is_array($listColor) && count($listColor)) { ?>
                                        <div class="slider-small">
                                            <?php foreach ($listColor as $keyC => $valC) { ?>
                                                <a href="javascript:void(0)"
                                                   style="background: <?php echo $valC['color'] ?>">
                                                </a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                    <div class="nav-item1">
                                        <h3 class="title-product"><a
                                                    href="<?php echo $href ?>"><?php echo $val['title'] ?></a></h3>
                                        <p class="price"><?php echo $getPrice['price_final'] ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    <?php } ?>



</div>
