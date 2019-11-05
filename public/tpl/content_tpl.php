<!--页头说明-->
<div class="row">
    <div class="col-md-12">
        <div class="page-header">
            <h2><?php echo $artCurrent[0]['title']; ?></h2>
        </div>
    </div>

<!--    <div class="col-md-4">
        <div class="page-header">
            <h2> <small>阅读排行榜</small></h2>
        </div>
    </div> -->

</div>

<!--    用带标题的面板做博文详情页-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div>
                    <ol class="breadcrumb">
                        <li><a href="#">首页</a></li>
                        <li><a href="#"><?php echo $catName;?></a></li>
                        <li class="active"><?php echo $artCurrent[0]['title']; ?></li>
                    </ol>
                </div>
                <div class="panel-body">
                    <?php
                        //将博文内容先解码:实体字符转预定义标签
                        $content = htmlspecialchars_decode($artCurrent[0]['content']);

                        //将转码后的内容显示出来
                        echo $content;
                         ?>
                </div>
            </div>
        </div>

        <!--右边推荐列表-->
        <?php include 'public/inc/right_inc.php';?>
    </div>


