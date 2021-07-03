<div id="main" class="wrapper main-new">

    <div class="breadcrumb">
        <div class="container">
            <ul>
                <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>
                <?php foreach ($breadcrumb as $key => $val) { ?>
                    <?php
                    $title = $val['title'];
                    $href = rewrite_url($val['canonical'], true, true);
                    ?>
                    <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a
                                href="<?php echo $href; ?>"
                                title="<?php echo $title; ?>"> / <?php echo $title; ?></a>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>

    <section class="content-new wow fadeInUp ">
        <div class="container">
            <div class="title-title center">
                <h2 class="title-primary"><?php echo $detailCatalogue['title'] ?></h2>
                <p class="desc"><?php echo $detailCatalogue['description'] ?></p>
            </div>
            <div class="nav-content-new">
                <div class="row">
                    <?php if (isset($articleList) && is_array($articleList) && count($articleList)) { ?>
                        <?php $i=0; foreach ($articleList as $key => $val) { $i++;?>
                            <?php
                            $title = $val['title'];
                            $image = $val['image'];
                            $href = rewrite_url($val['canonical'], TRUE, TRUE);
                            $description = cutnchar(strip_tags($val['description']), 100);
                            ?>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <div class="item">
                                    <div class="image">
                                        <a href="<?php echo $href; ?>"><img src="<?php echo $image; ?>"
                                                                            alt="<?php echo $title; ?>"></a>
                                    </div>
                                    <h3 class="title"><a href="<?php echo $href; ?>"><?php echo $title; ?></a></h3>
                                    <p class="desc"><?php echo $description; ?> </p>
                                    <a href="<?php echo $href; ?>" class="readmore">Xem chi tiết [+]</a>
                                </div>
                            </div>
                            <?php if($i%2==0){?><div class="clearfix"></div><?php }?>
                        <?php } ?>
                    <?php } ?>


                </div>
            </div>

            <div class="pagenavi">
                <ul>
                    <li>
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>

                    </li>
                </ul>
            </div>
        </div>
    </section>


</div>
