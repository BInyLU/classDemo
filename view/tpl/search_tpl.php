<div class="aw-container-wrap">
	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-12 aw-main-content" style="border-right: 0px solid #e6e6e6;">
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
											<a target="_blank" href="<?php echo $v['url']; ?>"><?php echo $v['bbs_title']; ?></a>
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
					</div>
				</div>
			</div>
		</div>
	</div>
</div>