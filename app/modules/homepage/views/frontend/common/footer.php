
<div style="clear: both"></div>
<div id="footer-shomesolution">
    <?php
    if (!$taisaochonchungtoi = $this->cache->get('taisaochonchungtoi')) {
        $taisaochonchungtoi = $this->Autoload_Model->_get_where(array(
            'select' => 'id, title',
            'table' => 'page_catalogue',
            'where' => array('ishome' => 1, 'publish' => 0, 'alanguage' => $this->fc_lang)));
        if (isset($taisaochonchungtoi) && is_array($taisaochonchungtoi) && count($taisaochonchungtoi)) {
            $taisaochonchungtoi['post'] = $this->Autoload_Model->_condition(array(
                'module' => 'page',
                'select' => '`object`.`id`, `object`.`title`, `object`.`image`, `object`.`description`',
                'where' => '`object`.`publish` = 0 AND `object`.`alanguage` = \'' . $this->fc_lang . '\' ',
                'catalogueid' => $taisaochonchungtoi['id'],
                'limit' => 4,
                'order_by' => '`object`.`order` asc, `object`.`id` desc',
            ));
        }
        $this->cache->save('taisaochonchungtoi', $taisaochonchungtoi, 200);
    }

    ?>
    <?php
    if (isset($taisaochonchungtoi['post']) && is_array($taisaochonchungtoi['post']) && count($taisaochonchungtoi['post'])) {
        ?>
        <div class="footer-top-content">
            <div class="container">
                <div class="top-footer"><h2 class="title"><?php echo $this->fcSystem['title_title_6'] ?></h2>
                    <div class="benefit">

                        <?php foreach ($taisaochonchungtoi['post'] as $k => $v) { ?>
                            <div class="benefit-item">
                                <div class="image"><a href="javascript:void(0)"> <img
                                                src="<?php echo $v['image'] ?>" width="101"
                                                height="70" alt="<?php echo $v['title'] ?>"></a></div>
                                <div><p><?php echo $v['title'] ?></p></div>
                                <?php if($v['description'] != ''){?>
                                <div class="detail"><?php echo strip_tags($v['description']) ?></div>
                                <?php }?>
                            </div>
                        <?php } ?>

                    </div>

                    <style>
                        body.category-nem #shomesolution-product-filter .block.product-list .arrange-fill .item-product .tile-content .tile-primary .custom-content, body[class*=category-nem-] #shomesolution-product-filter .block.product-list .arrange-fill .item-product .tile-content .tile-primary .custom-content {
                            display: none
                        }

                        body.category-nem #shomesolution-product-filter .block.product-list .arrange-fill .item-product .tile-content .tile-primary .left-content-info, body[class*=category-nem-] #shomesolution-product-filter .block.product-list .arrange-fill .item-product .tile-content .tile-primary .left-content-info {
                            max-width: 100%
                        }
                    </style>
                </div>
            </div>
        </div>
    <?php } ?>


    <div style="clear: both"></div>
    <div class="container">
        <div class="bottom-footer">
            <div class="bottom-footer-container">
                <div class="bottom-footer-item report">
                    <div class="image"><a href="<?php echo base_url() ?>"><img
                                    src="<?php echo $this->fcSystem['homepage_logo'] ?>"
                                    alt="<?php echo $this->fcSystem['homepage_company'] ?>"></a></div>
                    <p>Hotline:<br><span><a
                                    href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>"><?php echo $this->fcSystem['contact_hotline'] ?></a></span>
                    </p>
                    <p>Số điện thoại<br><span><a
                                    href="tel:<?php echo $this->fcSystem['contact_phone'] ?>"><?php echo $this->fcSystem['contact_phone'] ?></a></span>
                    </p>
                    <p>E-mail<br><span><?php echo $this->fcSystem['contact_email'] ?></span></p>
                    <p><?php echo $this->fcSystem['contact_timelv'] ?></p>
                </div>

                <?php $main_nav = navigation(array('keyword' => 'footer', 'output' => 'array'), $this->fc_lang); ?>
                <?php if (svl_ismobile() == 'is mobile') { ?>
                    <?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>
                        <?php $i=0; foreach ($main_nav as $key => $val) { $i++;?>
                            <div class="bottom-footer-item">
                                    <p class="title-bottom"><span><?php echo $val['title']; ?></span></p>
                                    <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>

                                        <?php foreach ($val['children'] as $keyItem => $valItem) { ?>
                                            <p><a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a></p>
                                        <?php } ?>


                                </div>
                                <?php if($i%2==0){?><div style="clear: both"></div><?php }?>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <div class="bottom-footer-item">

                    <p class="social"><span>Social</span></p>
                    <div class="social-symbol">
                        <div class="fb-symbol"><a
                                    href="<?php echo $this->fcSystem['social_facebook'] ?>"
                                    target="_blank" rel="noopener"><i aria-hidden="true"
                                                                      class="fa fa-facebook"></i></a>
                        </div>
                        <div class="symbol"><a href="<?php echo $this->fcSystem['social_youtube'] ?>"
                                               target="_blank" rel="noopener"><i aria-hidden="true"
                                                                                 class="fa fa-youtube"></i></a>
                        </div>
                        <div class="symbol"><a href="<?php echo $this->fcSystem['social_instagram'] ?>"
                                               target="_blank" rel="noopener"><i aria-hidden="true"
                                                                                 class="fa fa-instagram"></i></a>
                        </div>
                    </div>

                </div>
                <?php } else { ?>
                    <?php if (isset($main_nav) && is_array($main_nav) && count($main_nav)) { ?>
                        <?php foreach ($main_nav as $key => $val) { ?>
                            <div class="bottom-footer-item">
                            <p class="title-bottom"><span><?php echo $val['title']; ?></span></p>
                            <?php if (isset($val['children']) && is_array($val['children']) && count($val['children'])) { ?>

                                <?php foreach ($val['children'] as $keyItem => $valItem) { ?>
                                    <p><a href="<?php echo $valItem['link'] ?>"><?php echo $valItem['title'] ?></a></p>
                                <?php } ?>
                                <?php if ($key == 0) { ?>
                                    <p class="social"><span>Social</span></p>
                                    <div class="social-symbol">
                                        <div class="fb-symbol"><a
                                                    href="<?php echo $this->fcSystem['social_facebook'] ?>"
                                                    target="_blank" rel="noopener"><i aria-hidden="true"
                                                                                      class="fa fa-facebook"></i></a>
                                        </div>
                                        <div class="symbol"><a href="<?php echo $this->fcSystem['social_youtube'] ?>"
                                                               target="_blank" rel="noopener"><i aria-hidden="true"
                                                                                                 class="fa fa-youtube"></i></a>
                                        </div>
                                        <div class="symbol"><a href="<?php echo $this->fcSystem['social_instagram'] ?>"
                                                               target="_blank" rel="noopener"><i aria-hidden="true"
                                                                                                 class="fa fa-instagram"></i></a>
                                        </div>
                                    </div>
                                <?php } ?>

                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>


            </div>
            <div class="benefit">
                <div class="moit">
                    <a href="<?php echo $this->fcSystem['link_bct'] ?>" rel="noopener">
                        <img src="template/frontend/images/bocongthuong.svg" alt="bo-cong-thuong-logo">
                    </a>
                </div>
                <div class="copy-right">
                    <p><?php echo $this->fcSystem['homepage_masodn'] ?></p>

                    <div class="payment-method">
                        <div>
                            <img src="template/frontend/images/icon-COD.svg"
                                 alt="COD-logo"></div>
                        <div><img
                                    src="template/frontend/images/visa.svg"
                                    alt="visa-logo"></div>
                        <div><img
                                    src="template/frontend/images/master-card.svg"
                                    alt="mastercard-logo"></div>
                        <div><img
                                    src="template/frontend/images/america-express.svg"
                                    alt="america-express-logo"></div>
                        <div><img
                                    src="template/frontend/images/JCB.svg"
                                    alt="JCB-logo"></div>
                        <div><img
                                    src="template/frontend/images/onepay.svg"
                                    alt="onepay-logo"></div>
                        <div><img
                                    src="template/frontend/images/VN-pay.svg"
                                    alt="VNPay-logo"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="shomesolution-buttoninteractive">
    <div class="live-chat"><a href="<?php echo $this->fcSystem['social_facebookm'] ?>" class="items-action messenger">
            <img src="template/frontend/images/messenger.png">
            <div class="title-action">Chat với chúng tôi</div>
        </a> <a href="tel:<?php echo $this->fcSystem['contact_hotline'] ?>" class="items-action phone"><img
                    src="template/frontend/images/callnow.png">
            <div class="title-action"><b><?php echo $this->fcSystem['contact_hotline'] ?></b></div>
        </a></div>
</div>
<div id="shomesolution-icon-landing"></div>
<div id="back-top"><a title="Phần trên" href="#top">Phần trên</a></div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.0.0-beta.3/owl.carousel.min.js"></script>
<script>

    $(document).ready(function () {
        var sync1 = $('.slider-image')
        var sync2 = $('.detail-slider')
        var slidesPerPage = 4
        var syncedSecondary = true
        sync1.owlCarousel({
            animateOut: "fadeOut",
            animateIn: "fadeIn",
            loop: true,
            startPosition: 0,
            rtl: ThemeOptions.rtl_layout == 1 ? true : false,
            autoplay: true,
            autoplayHoverPause: true,
            autoplaySpeed: false,
            nav: true,
            dots: false,
            lazyLoad: false,
            URLhashListener: false,
            items: 1,
            responsiveRefreshRate: 200
        }).on('changed.owl.carousel', syncPosition)
        sync2
            .on('initialized.owl.carousel', function () {
                sync2.find('.owl-item').eq(0).addClass('current')
            })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                nav: false,
                slideBy: slidesPerPage,
                responsiveRefreshRate: 100,
                responsive: {
                    768: {
                        items: 2
                    },
                    992: {
                        items: 3
                    },
                    1200: {
                        items: slidesPerPage
                    },
                }
            }).on('changed.owl.carousel', syncPosition2)

        function syncPosition(el) {
            var count = el.item.count - 1
            var current = Math.round(el.item.index - (el.item.count / 2) - 0.5)
            if (current < 0) {
                current = count
            }
            if (current > count) {
                current = 0
            }
            sync2
                .find('.owl-item')
                .removeClass('current')
                .eq(current)
                .addClass('current')
            var onscreen = sync2.find('.owl-item.active').length - 1
            var start = sync2.find('.owl-item.active').first().index()
            var end = sync2.find('.owl-item.active').last().index()
            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true)
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true)
            }
        }

        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index
                sync1.data('owl.carousel').to(number, 100, true)
            }
        }

        sync2.on('click', '.owl-item', function (e) {
            e.preventDefault()
            var number = $(this).index()
            sync1.data('owl.carousel').to(number, 300, true)
        })
    });
    $('.sidebar-mobile').on('click', function () {


        $('#header-bottom').addClass('open');
        $('#sidebar-mobile-close').addClass('open');

    });
    $('#sidebar-mobile-close').on('click', function () {

        $('#header-bottom').removeClass('open');
        $('#sidebar-mobile-close').removeClass('open');

    });
    $('#mini-cart').on('click', function () {
        $('#mini-cart .overlay').addClass('active');
        $('#mini-cart-block').addClass('active');

    });
    $('#close-minicart-cart').on('click', function () {
        $('.overlay').removeClass('active');
        $('#mini-cart-block').removeClass('active');

    })
    $('.block-banner-list-mobile').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.slick-slider-1').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 4
            }
        }
    });
    $('.cool-lightbox__navigation_slide').owlCarousel({
        loop: true,
        margin: 10,
        nav: false,
        dots: false,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            1000: {
                items: 1
            }
        }
    });
    $('.search-form-container').mousemove(function () {
        $('.v-autocomplete').show();
    });
    $('.v-autocomplete').mouseout(function () {
        $('.v-autocomplete').hide();
    });

    $('.search-bar-mobile').mousemove(function () {
        $('.search-bottom').show();
    });
    // $('#search_mini_form').mouseleave(function () {
    //     $('.v-autocomplete').hide();
    //     $('#bodyFull').hide();
    // });
    $(document).on('keyup change', '#search', function () {
        let keyword = $(this).val();
        let object = {
            'keyword': keyword,
        };
        keyword = keyword.trim();
        if (keyword.length > 2) {
            time = setTimeout(function () {
                get_list_object_search(object);
            }, 500);
        } else {
            time = setTimeout(function () {
                get_list_object_search(object);
            }, 500);
        }
    });

    function get_list_object_search(param) {
        let ajaxUrl = 'search-autocomplete.html';
        $.get(ajaxUrl, {keyword: param.keyword},
            function (data) {
                let json = JSON.parse(data);
                $('.v-autocomplete').html(json.html);
            });
    }

</script>
<style>
    .v-autocomplete, #bodyFull {
        display: none;
    }

</style>