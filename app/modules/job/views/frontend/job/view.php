<div id="main" class="wrapper main-car-detail main-cars-list" style="margin-top: 20px;">
    <div id="main-contact">
        <div class="container">
            <div class="">
                <ul class="breadcrumb">
                    <li><a href="<?php echo base_url() ?>">Trang chủ</a></li>

                    <?php foreach ($breadcrumb as $key => $val) { ?>
                        <?php
                        $title = $val['title'];
                        $href = rewrite_url($val['canonical'], true, true);
                        ?>
                        <li class="<?php if ($key == count($breadcrumb) - 1) echo 'uk-active'; ?>"><a
                                    href="<?php echo $href; ?>"
                                    title="<?php echo $title; ?>"><?php echo $title; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <div class="row">

                <div class="col-md-9 col-sm-9 col-xs-12 wow fadeInUp" style="visibility: visible; animation-name: fadeInUp;">
                    <h1 style="font-size: 22px;font-weight: bold;line-height: 25px;"><?php echo $detailjob['title']; ?></h1>
                    <p class="date"><i>Ngày đăng: <?php echo $detailjob['created']; ?>&nbsp;&nbsp;Lượt xem: <?php echo $detailjob['viewed']; ?></i></p>
                    <?php echo $detailjob['description']; ?>
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
                        <div class="fb-comments" data-href="<?php echo $canonical?>" data-numposts="20" ></div>
                    </div>
                    <style>
                        .content-new-detail img {
                            max-width: 100% !important;
                            height: auto !important;
                        }
                    </style>

                    <?php if(!empty($jobs_same)){?>
                    <div class="clearfix"></div>
                    <h2 style="font-size: 22px;font-weight: bold">Bài viết cùng chuyên mục</h2>
                    <ul class="ttm-list">
                        <?php foreach ($jobs_same as $keyP => $valP) {
                            $href = rewrite_url($valP['canonical'], true, true); ?>
                            <li><a href="<?php echo $href ?>"><i class="fa fa-check"></i><span class="ttm-list-li-content"><?php echo $valP['title'] ?></span></a></li>
                        <?php } ?>

                    </ul>
                    <?php }?>



                </div>
                <?php echo $this->load->view('homepage/frontend/common/aside'); ?>

            </div>
        </div>
    </div>
</div>
<style>
    .blog-item .itemBlogImg,.itemBlogContent{
        padding: 0px 5px;
    }
    .blog-item-inner{
        margin: 0px -5px;
    }
    .blog-item{
        margin-bottom: 20px;
    }
</style>
<style>
    .ttm-list{
        list-style: none;
        padding: 0px;
        margin: 0px;
    }
    .ttm-list-li-content{
        padding-left: 5px;
    }
</style>
