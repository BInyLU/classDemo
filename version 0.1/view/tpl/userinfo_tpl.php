<style type="text/css">.fancybox-margin{margin-right:17px;}</style>
<div class="aw-container-wrap">
	<div class="container">
		<div class="row">
			<div class="aw-content-wrap clearfix">
				<div class="aw-user-setting">
					<div class="tabbable">
						<ul class="nav nav-tabs aw-nav-tabs active">
							<h2><i class="icon icon-setting"></i> 用户编辑</h2>
						</ul>
					</div>
					<div class="tab-content clearfix">
						<form method="post" action="/index.php?a=userinfo" enctype="multipart/form-data">
							<div class="aw-mod">
								<!-- 基本信息 -->
								<div class="mod-body">
									<div class="aw-mod mod-base">
										<div class="mod-head">
											<h3>基本信息</h3>
										</div>
										<div class="mod-body">
											<dl>
												<dt>账号&nbsp;&nbsp;:&nbsp;&nbsp;</dt>
												<dd><?php echo $userList['account'] ?></dd>
											</dl>
											<dl>
												<dt>头像&nbsp;&nbsp;:&nbsp;&nbsp;</dt>
												<dd>
													<input class="form-control" name="head" type="file" accept="image/jpeg,image/gif,image/png">
												</dd>
											</dl>

											<dl>
												<dt>昵称&nbsp;&nbsp;:&nbsp;&nbsp;</dt>
												<dd>
													<input class="form-control" name="nickname" type="text" value="<?php echo $userList['nickname'] ?>">
												</dd>
											</dl>
											<dl>
												<dt>密码&nbsp;&nbsp;:&nbsp;&nbsp;</dt>
												<dd>
													<input class="form-control" name="psword" type="password" value="">
												</dd>
											</dl>
										</div>
									</div>
								</div>
								<!-- end 基本信息 -->
								<div class="mod-footer clearfix">
									<input type="submit" value="保存" class="btn btn-large btn-success pull-right" />
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>