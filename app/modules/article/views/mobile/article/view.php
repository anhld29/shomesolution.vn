<div id="main" class="wrapper main-new main-new-detail">

    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url()?>">Trang chủ</a></li>
                <?php foreach ($breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], true, true);
                    ?>
                    <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a href="<?php echo $href; ?>"
                                                                                                  title="<?php echo $title; ?>"> / <?php echo $title; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <section class="content-new wow fadeInUp ">
        <div class="container">
            <h1 class="title-pri"><?php echo $detailArticle['title']; ?></h1>
            <p class="date">Ngày đăng: <?php echo $detailArticle['created']; ?></p>
            <div class="nav-content-new">
                <div class="s">
                    <?php echo $detailArticle['description']; ?>

                </div>
                <div style="clear: both;height: 20px;"></div>
                <div class="a2a_kit a2a_kit_size_32 a2a_default_style">
                    <a class="a2a_dd" href="https://www.addtoany.com/share"></a>
                    <a class="a2a_button_facebook"></a>
                    <a class="a2a_button_twitter"></a>
                    <a class="a2a_button_google_plus"></a>
                    <a class="a2a_button_skype"></a>
                </div>
                <script async src="https://static.addtoany.com/menu/page.js"></script>
                <div style="clear: both;height: 20px;"></div>
                <div style="margin: 0px -8px">
                    <div class="fb-comments" data-href="<?php echo $canonical?>" data-numposts="20"></div>
                </div>
                <style>
                    .nav-content-new .s img {
                        max-width: 100% !important;
                        height: auto !important;
                    }
                </style>
                <?php if (isset($articles_same)  && is_array($articles_same) && count($articles_same)) { ?>

                <div class="new-other">
                    <h2 class="title-other">
                        Các tin khác
                    </h2>
                    <div class="owl-carousel slider-other">

                        <?php foreach ($articles_same as $keyP => $valP) {
                            $title = $valP['title'];
                            $image = $valP['image'];
                            $href = rewrite_url($valP['canonical'], TRUE, TRUE);
                            $description = cutnchar(strip_tags($valP['description']), 100); ?>
                            <div class="item">
                                <div class="image">
                                    <a href="<?php echo $href; ?>"><img src="<?php echo $image; ?>" alt="<?php echo $title; ?>"></a>
                                </div>
                                <h3 class="title"><a href="<?php echo $href; ?>"><?php echo $title; ?></a></h3>
                                <p class="desc"><?php echo $description; ?> </p>
                                <a href="<?php echo $href; ?>" class="readmore">Xem chi tiết [+]</a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <?php }?>

            </div>


        </div>
    </section>


</div>
