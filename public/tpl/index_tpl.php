<!--页头说明-->
<div class="row" style="display: none;">
    <div class="col-md-10">
        <div class="page-header">
            <h2>
                <?php echo isset($catName) ? strtoupper($catName):'';?>最新博文</h2>
        </div>
    </div>

   <div class="col-md-4">
        <div class="page-header">
            <h2> <small>阅读排行榜</small></h2>
        </div>
    </div>

</div>


<!--左边列表-->
<div class="row" >
    <div class="col-md-12" >
        <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
            <?php foreach($artList as $art) :?>

            <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="headingOne">
                    <h4 class="panel-title">
                        <a role="button" data-toggle="collapse" data-parent="#accordion" href="/index.php<?php echo $art['title_url']; //详情 ?>" aria-expanded="true" aria-controls="collapseOne" title="<?php echo $art['title']; //标题 ?>">
                           <?php echo $art['title']; //标题 ?>
                        </a>
                    </h4>
                </div>
                <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                        <?php
                         //将内容实体转标签
                        $content = htmlspecialchars_decode($art['content']); //博文内容
                        //截取内容前的120个中文做为简介
                        $content = mb_substr($content,0,120,'utf-8');
                        echo  $content;
                        ?>
                        <a  class="btn btn-info btn-xs" href="/index.php<?php echo $art['title_url']; //详情 ?>" role="button" >点击阅读 >></a>
                    </div>
                </div>
            </div>

            <?php endforeach; ?>
        </div>
    </div>

<!--右边推荐列表-->
    <?php include 'public/inc/right_inc.php' ?>
</div>


<!--分页类模板调度-->
<?php

    //获取当前页数
    //如果get存在page参数则将当前页设置为get值,否则设置为1,即默认为第1页
    $pageCurrent = isset($_GET['page'])?$_GET['page']:1;
    //加载首页的分页模板
    include 'public/tpl/page_tpl.php';

?>


