<div class="aw-container-wrap">
	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<!-- tab切换 -->
					<ul class="nav nav-tabs aw-nav-tabs active hidden-xs">
						<li <?php  if($bbsType==2){ echo 'class="active"'; } ?>><a href="index.php?a=list&type=2">热门</a></li>
						<li <?php  if($bbsType==1){ echo 'class="active"'; } ?> ><a href="index.php?a=list">最新</a></li>
					</ul>
					<!-- end tab切换 -->
					<div class="aw-mod aw-explore-list">
						<div class="mod-body">
							<div class="aw-common-list">
								<?php if($bbsList){ foreach($bbsList as $v){	?>
								<div class="aw-item active">
									<div class="aw-user-name hidden-xs">
                            			<img style="width:32px;height:32px;" src="<?php echo !empty($v['head'])?$v['head']:'static/img/avatar-max-img.png'; ?>" />
									</div>	
									<div class="aw-question-content">
										<h4>
											<a href="<?php echo $v['url']; ?>"><?php echo $v['bbs_title']; ?></a>
										</h4>
										<p>
											<span class="aw-user-name"><?php echo $v['nickname']; ?></span> 
											<span class="text-color-999">发起了帖子 • <?php echo $v['browse']; ?> 次浏览 • <?php echo $v['add_time']; ?> </span>
										</p>
									</div>
								</div>
								<?php }} ?>
							</div>
						</div>
						<div class="mod-footer">
							<div class="page-control">
								<ul class="pagination pull-right">
								<?php echo $bbsListPage; ?>
								</ul>
							</div>						
						</div>
					</div>
				</div>
				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs hidden-sm">
					<div class="aw-mod">
						<div class="mod-head">
							<h3>热门帖子</h3>
						</div>
						<div class="mod-body font-size-12">
							<ul>
								<?php if($bbsListHot){ foreach($bbsListHot as $hot){ ?>
								<li><a href="<?php echo $hot['url']; ?>"><?php echo $hot['bbs_title'] ?></a></li>
								<?php }} ?>
							</ul>
						</div>
					</div>
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>