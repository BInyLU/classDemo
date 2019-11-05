<div class="aw-container-wrap">
    <div class="container">
        <div class="row">
            <div class="aw-content-wrap clearfix">
                <div class="col-sm-12 col-md-12 aw-main-content" style="border-right:0px;">
                    <!-- 用户数据内容 -->
                    <div class="aw-mod aw-user-detail-box">
                        <div class="mod-head">
                            <img style="width:100px;height:100px;" src="<?php echo !empty($userList['head'])?$userList['head']:'static/img/avatar-max-img.png'; ?>" />
                            <span class="pull-right operate">
                                <a href="index.php?a=userinfo" class="btn btn-mini btn-success">编辑</a>
                            </span>
                            <h1><?php echo $userList['nickname']; ?> </h1>
                            <p class="text-color-999">
                                <?php if($userList['is_admin'] == 1){echo '管理员';}else{echo '普通用户';} ?>
                            </p>
                        </div>
                    </div>
                    <!-- end 用户数据内容 -->
                    <div class="aw-user-center-tab">
                        <div class="tab-content">
                            <div class="tab-pane active">
                                <!-- 发帖 -->
                                <div class="aw-mod">
                                    <div class="mod-head">
                                        <h3>已发帖</h3>
                                    </div>
                                    <?php if($bbsList){ foreach($bbsList as $bbs_v){ ?>
                                    <div class="mod-body">
                                        <div class="aw-profile-publish-list">
                                            <div class="aw-item" style="padding-top:5px;">
                                                <div class="mod-head">
                                                    <h4>
                                                        <a href="<?php echo $bbs_v['url'] ?>"><?php echo $bbs_v['bbs_title'] ?></a>
                                                        <span class="pull-right operate" onclick="del( '<?php echo $bbs_v['delurl']; ?>' ) " >
                                                            &nbsp;<a href="javascript:void(0)" class="btn btn-mini btn-danger">删除</a>
                                                        </span>
                                                        <span class="pull-right operate">
                                                            &nbsp;<a href="<?php echo $bbs_v['editurl'] ?>" class="btn btn-mini btn-success">修改</a>
                                                        </span>
                                                        <?php if($userList['is_admin']==1){ if($bbs_v['is_hot']==1){ ?>
                                                        <span class="pull-right operate">
                                                            &nbsp;<a href="<?php echo $bbs_v['nhoturl'] ?>" class="btn btn-mini btn-info">取消热门</a>
                                                        </span>
                                                        <?php }else{ ?>
                                                        <span class="pull-right operate">
                                                            &nbsp;<a href="<?php echo $bbs_v['hoturl'] ?>" class="btn btn-mini btn-warning">热门</a>
                                                        </span>
                                                        <?php }} ?>
                                                    </h4>
                                                </div>
                                                <div class="mod-body">
                                                    <span class="aw-border-radius-5 count pull-left"><i class="icon icon-reply"></i><?php echo $bbs_v['count'] ?></span>
                                                    <p class="aw-hide-txt"><?php echo $bbs_v['browse'] ?> 次浏览 &nbsp;• <?php echo $bbs_v['add_time'] ?> <?php if($userList['is_admin']==1){ echo ' &nbsp;• 发帖人 ：'.$bbs_v['nickname']; } ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }} ?>
                                </div>
                                <!-- end 发帖 -->
                            </div>
                            <div class="mod-footer aw-feed-list">
                                <div class="page-control">
                                    <ul class="pagination pull-right">
                                    <?php echo $bbsListPage; ?>
                                    </ul>
                                </div>                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
function del(url){
    if(confirm("确认删除吗")){
        window.location.href=url;
    }
    else{
        return;
    }
}
</script>