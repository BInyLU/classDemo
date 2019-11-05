<div class="aw-container-wrap">
	<div class="container aw-publish">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="col-sm-12 col-md-9 aw-main-content">
					<!-- tab 切换 -->
					<ul class="nav nav-tabs aw-nav-tabs active">
						<h2 class="hidden-xs"><i class="icon icon-ask"></i> 修改发贴</h2>
					</ul>
					<!-- end tab 切换 -->
					<form action="" method="post">
						<input type="text" name="id" value="<?php echo $details['bbs_id'] ?>" class="hide">
						<div class="aw-mod aw-mod-publish">
							<div class="mod-body">
								<h3>标题:</h3>
								<!-- 问题标题 -->
								<div class="aw-publish-title active">
									<div>
										<input type="text" placeholder="标题..." name="bbs_title" value="<?php echo nl2br($details['bbs_title']) ?>" class="form-control">
									</div>
								</div>
								<!-- end 问题标题 -->
								<h3>内容:</h3>
								<div class="aw-mod aw-editor-box">
									<div class="mod-head">
										<div class="wmd-panel">
											<textarea class="wmd-input form-control autosize" rows="15" name="bbs_content" style="overflow: hidden; word-wrap: break-word; resize: none; height: 312px;"><?php echo nl2br($details['bbs_content']) ?></textarea>
								        </div>
									</div>
								</div>
							</div>
							<div class="mod-footer clearfix">
								<input type="submit" value="修改发帖" class="btn btn-large btn-success btn-publish-submit">
							</div>
						</div>
					</form>
				</div>
				<!-- 侧边栏 -->
				<div class="col-sm-12 col-md-3 aw-side-bar hidden-xs">
					<!-- 问题发起指南 -->
					<div class="aw-mod publish-help">
						<div class="mod-head">
							<h3>发贴指南</h3>
						</div>
						<div class="mod-body">
							<p><b>• </b> 不能言论时政</p>
							<p><b>• </b> 不能发黄色内容</p>
							<p><b>• </b> 违反会被封号</p>
							<p><b>• </b> 请珍惜账号</p>
						</div>
					</div>
					<!-- end 问题发起指南 -->
				</div>
				<!-- end 侧边栏 -->
			</div>
		</div>
	</div>
</div>