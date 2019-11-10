<div class="aw-container-wrap">
	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<div class="aw-mod aw-question-detail aw-item">
						<div class="mod-head">
							<h1><?php echo $details['bbs_title']; ?></h1>
						</div>
						<div class="mod-body">
							<div class="content markitup-box"><?php echo nl2br($details['bbs_content']); ?></div>
						</div>
						<div class="mod-footer">
							<div class="meta text-color-999">
								<span><?php echo $details['add_time']; ?></span>
								<span class="aw-text-color-blue">浏览: <?php echo $details['browse']; ?></span>
							</div>
						</div>
					</div>
					<!-- 回复编辑器 -->
					<div class="aw-mod aw-article-replay-box">
						<form action="/index.php?a=comment" method="post">
							<input type="text" name="bbs_id" value="<?php echo $details['bbs_id'] ?>" class="hide">
							<div class="mod-head">
								<a href="" class="aw-user-name">
									<img style="width:32px;height:32px;" src="<?php echo !empty($userList['head'])?$userList['head']:'static/img/avatar-max-img.png'; ?>" />
								</a>
							</div>
							<div class="mod-body">
								<textarea rows="3" name="content" class="form-control autosize" placeholder="写下你的评论..." style="overflow: hidden; word-wrap: break-word; resize: none; height: 74px;"></textarea>
							</div>
							<div class="mod-footer pull-right clearfix">
								<input type="submit" value="评论" class="btn btn-large btn-success btn-publish-submit">
							</div>
						</form>
					</div>
					<!-- end 回复编辑器 -->
					<div class="aw-mod aw-question-comment" style="margin-top:50px;">
						<div class="mod-head">
							<ul class="nav nav-tabs aw-nav-tabs active"></ul>
						</div>
						<?php if($comment){ foreach($comment as $com){ ?>
						<div class="mod-body aw-feed-list">
							<div class="aw-item">
								<div class="mod-head">
									<!-- 用户头像 -->
									<a class="aw-user-img aw-border-radius-5 pull-right" href="javascript:void(0);" >
										<img style="width:32px;height:32px;" src="<?php echo !empty($com['head'])?$com['head']:'static/img/avatar-max-img.png'; ?>" />
									</a>
									<div class="title">
										<p>
											<a class="aw-user-name" href="javascript:void(0);"><?php echo $com['nickname']; ?></a>
											<span class="text-color-999 pull-right"><?php echo date('Y-m-d H:i',$com['add_time']); ?></span>
										</p>
									</div>
								</div>
								<div class="mod-body clearfix">
									<!-- 评论内容 -->
									<div class="markitup-box"><?php echo nl2br($com['content']); ?></div>
									<!-- end 评论内容 -->
								</div>
							</div>
						</div>
						<?php }} ?>
					</div>
					<div class="mod-footer aw-feed-list">
						<div class="page-control">
							<ul class="pagination pull-right">
							<?php echo $bbsListPage; ?>
							</ul>
						</div>
					</div>
					<!-- end 问题详细模块 -->
				</div>
				<!-- 侧边栏 -->
				<div class="col-md-3 aw-side-bar hidden-xs hidden-sm">
					<!-- 发起人 -->
					<div class="aw-mod">
						<div class="mod-head">
							<h3>发起人</h3>
						</div>
						<div class="mod-body">
							<dl>
								<dt class="pull-left aw-border-radius-5">
									<a href="javascript:void(0);">
                            			<img style="width:32px;height:32px;" src="<?php echo !empty($pUserList['head'])?$pUserList['head']:'static/img/avatar-max-img.png'; ?>" />
									</a>
								</dt>
								<dd class="pull-left">
									<a class="aw-user-name" href="javascript:void(0);"><?php echo $pUserList['nickname']; ?></a>
									<i class="icon-v" title="个人认证"></i>
									<p></p>
								</dd>
							</dl>
						</div>
					</div>
					<!-- end 发起人 -->
					<!-- 热门 -->
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
					<!-- end 热门 -->
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>