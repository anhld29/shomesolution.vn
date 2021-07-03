<div id="main" class="wrapper main-Handbook">

    <div class="top-title">
        <div class="container-fluid">
            <h2 class="title-primary1" style=""><?php echo $detailCatalogue['title'] ?></h2>
        </div>
    </div>
    <section class="content-Experimental">
        <div class="container-fluid">

            <div class="content-Handbook-center box"
                 style="background: transparent; border-radius: 0px;margin-bottom: 0px;box-shadow: 0px 0px;padding: 0px;">

                <h3 class="title" style="font-family: 'UVNTINTUCHEPTHEM BOLD';font-size: 20px;line-height: 34px;height: 34px;overflow: hidden;margin-top: 0px"><a href="javascript:void(0)"><?php echo $detailjob['title'] ?></a></h3>

                <div class="desc" style="height: 100% !important;">

                    <?php if ($detailjob['vitri'] != '' || $detailjob['diadiem'] != '' || $detailjob['mucluong'] != '') { ?>
                        <div class="thong-tin-bv">

                            <div class="title-filed"><span
                                    class="key">- Diện tích: </span><span><?php echo $detailjob['vitri'] ?></span>
                            </div>
                            <div class="title-filed"><span
                                    class="key">- Thời gian thi công: </span><span><?php echo $detailjob['diadiem'] ?></span>
                            </div>
                            <div class="title-filed"><span class="key">- Chi phí:</span> <span
                                    class="value chi_phi"><?php echo $detailjob['mucluong'] ?></span>
                            </div>
                        </div>
                        <div style="clear: both;height: 20px;"></div>
                    <?php } ?>


                    <?php echo $detailjob['description'] ?>

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
                    <div class="fb-comments" data-href="<?php echo $canonical ?>" data-numposts="20"  data-width="1140"></div>
                </div>
            </div>

            <div class="content-Handbook section-experience">
                <?php
                $job_quantam = $this->Autoload_Model->_get_where(array(

                    'select' => 'id, title, slug, canonical, image, description, created,viewed',

                    'table' => 'job',

                    'where' => array('id!= ' => $detailjob['id'],'alanguage' => $this->fc_lang),

                    'order_by' => 'viewed desc',

                    'limit' => 5,

                ), TRUE);
                ?>
                <?php if (isset($job_quantam) && is_array($job_quantam) && count($job_quantam)) { ?>
                <div class="row">

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <h2 class="title-primary1">Dự án nổi bật</h2>
                        <?php foreach ($job_quantam as $keyP => $valP) {
                        $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                        $canonicalP  = $hrefP;

                        ?>
                        <div class="content-Handbook-center box">
                            <div class="image">
                                <a href="<?php echo $hrefP?>"><img src="<?php echo $valP['image']?>" alt="<?php echo $valP['title']?>"></a>
                            </div>
                            <h3 class="title"><a href="<?php echo $hrefP?>"><?php echo $valP['title']?></a></h3>

                            <div class="center">
                                <ul class="list-share">
                                    <li><div class="fb-like" data-href="<?php echo $canonical?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div></li>
                                    <li style="display: flex;align-items: center;"><?php echo $valP['viewed'] ?>
                                        <img src="template/frontend/noithat-PC/images/i3.png"
                                             alt="<?php echo $valP['viewed'] ?>"></li>
                                </ul>
                            </div>
                        </div>
                        <?php }?>

                    </div>

                </div>
                <?php }?>


                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar-left">

                            <div class="item-sb">
                                <?php echo $this->load->view('homepage/frontend/common/experience-left') ?>

                            </div>

                        </div>


                    </div>
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="sidebar-right">
                            <?php if (isset($jobs_same) && is_array($jobs_same) && count($jobs_same)) { ?>

                            <div class="item-sb">
                                <h2 class="title-primary1">Bài viết cùng chuyên mục</h2>

                                <div class="content-Handbook-right box">
                                    <?php foreach ($jobs_same as $keyP => $valP) {
                                    $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                                    $canonicalP  = $hrefP;
                                    ?>
                                    <div class="item">
                                        <div class="image">
                                            <a href="<?php echo $hrefP ?>"><img src="<?php echo $valP['image'] ?>" alt="<?php echo $valP['title'] ?>"></a>
                                        </div>
                                        <div class="nav-image">
                                            <h3 class="title"><a href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a></h3>

                                            <p class="date"><?php echo show_time($valP['created'], 'd') ?>
                                                Tháng <?php echo show_time($valP['created'], 'm') ?>
                                                Năm <?php echo show_time($valP['created'], 'Y') ?></p>
                                        </div>
                                        <div class="clearfix"></div>
                                        <ul class="list-share">
                                            <li><div class="fb-like" data-href="<?php echo $canonicalP?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div></li>
                                            <li style="display: flex;align-items: center;"><?php echo $valP['viewed'] ?>
                                                <img src="template/frontend/noithat-PC/images/i3.png" alt="<?php echo $valP['viewed'] ?>">
                                            </li>
                                        </ul>
                                    </div>
                                    <?php }?>

                                </div>
                            </div>

                            <?php }?>

                            <div class="item-sb">
                                <?php echo $this->load->view('homepage/frontend/common/experience-right') ?>
                            </div>


                        </div>


                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php echo $this->load->view('homepage/frontend/common/tag') ?>
    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>

</div>
<style>
    .thong-tin-bv {
        background: #eeffeb;
        padding: 10px;
        margin: 0 auto;
        border: 1px dashed #ff8d65;
        margin-top: 10px;
        border-radius: 3px;
        font-size: 20px;
        line-height: 28px;
    }

    .thong-tin-bv .key {
        font-weight: bold;
    }
</style>
<style>
    .new-home, .title-title-small {
        display: none;
    }
</style>