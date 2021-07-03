<div id="main" class="wrapper main-project">


    <div class="top-title">
        <div class="container-fluid">
            <h2 class="title-primary1"><span><?php echo $detailCatalogue['title'] ?></span></h2>
        </div>
    </div>

    <section class="content-Experimental content-Experimental-bottom">
        <div class="container-fluid">
            <div class="top-category-project">
                <?php /*<div class="row">
                    <div class="col-md-3 col-sm-3 col-xs-12">
                        <div class="search">
                            <form action=""><input type="text" class="filter keyword" placeholder="Tìm kiếm"></form>
                        </div>
                    </div>

                </div>*/?>
            </div>
            <div class="row">
                <?php if (isset($jobList) && is_array($jobList) && count($jobList)) { ?>

                    <div class="content-Experimental-right"  id="ajax-content">
                        <?php foreach ($jobList as $keyP => $valP) {
                            $hrefP = rewrite_url($valP['canonical'], TRUE, TRUE);
                            $canonicalP  = $hrefP;

                            ?>
                            <div class="col-md-3 col-sm-3 col-xs-12">
                                <div class="item1">
                                    <div class="image">
                                        <a href="<?php echo $hrefP ?>"><img src="<?php echo $valP['image'] ?>"
                                                                            alt="<?php echo $valP['title'] ?>"></a>
                                    </div>
                                    <div class="nav-image">
                                        <h3 class="title"><a href="<?php echo $hrefP ?>"><?php echo $valP['title'] ?></a>
                                        </h3>
                                        <ul>
                                            <li><div class="fb-like" data-href="<?php echo $canonicalP?>" data-width="" data-layout="button" data-action="like" data-size="small" data-share="true"></div></li>
                                            <li style="display: flex;align-items: center;"><?php echo $valP['viewed'] ?>
                                                <img src="template/frontend/noithat-PC/images/i3.png"
                                                     alt="<?php echo $valP['viewed'] ?>"></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="clearfix"></div>
                    <div class="pagenavi" id="pagination">
                        <?php echo (isset($PaginationList)) ? $PaginationList : ''; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <?php echo $this->load->view('homepage/frontend/common/newHome') ?>

    <?php echo $this->load->view('homepage/frontend/common/tag') ?>
    <?php echo $this->load->view('homepage/frontend/common/mailsubricre') ?>


</div>
<?php /*<script>
    var time;
    $(document).on('keyup change','.filter', function(){
        let page = 40;
        time = setTimeout(function(){
            get_list_object(page);
        },500);
        return false;
    });
    $(document).on('click','#pagination li a', function(){
        let _this = $(this);
        let page = _this.attr('data-ci-pagination-page');
        time = setTimeout(function(){
            get_list_object(page);
        },500);
        return false;
    });
    function get_list_object(page = 1){

        let keyword = $('.keyword').val();
        let perpage = 40;
        let catalogueid = parseFloat(<?php echo $detailCatalogue['id']?>);


        let param = {
            'page'    : page,
            'keyword' : keyword,
            'perpage' : perpage,
            'catalogueid' : catalogueid,

        }
        let ajaxUrl = 'job/frontend/catalogue/listCatalogue';
        $.get(ajaxUrl, {
                perpage: param.perpage,
                keyword: param.keyword,
                page: param.page,
                catalogueid: param.catalogueid,
            },
            function(data){
                let json = JSON.parse(data);
                $('#ajax-content').html(json.html);
                $('#pagination').html(json.pagination);
            });
    }
</script>*/?>
