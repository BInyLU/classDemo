<!DOCTYPE html>
<html>
<head>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type" />
<meta content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" name="viewport" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,Chrome=1" />
<meta name="renderer" content="webkit" />
<title><?php echo SITE_SUFFIX; ?></title>
<link rel="shortcut icon" type="image/x-icon" href="static/img/favicon.ico" >

<link rel="stylesheet" type="text/css" href="static/css/bootstrap.css" />
<link rel="stylesheet" type="text/css" href="static/css/icon.css" />
<link href="static/css/common.css" rel="stylesheet" type="text/css" />
<link href="static/css/link.css" rel="stylesheet" type="text/css" />
<link href="static/css/user.css" rel="stylesheet" type="text/css" />
<link href="static/css/user-setting.css" rel="stylesheet" type="text/css">

<script src="static/js/jquery.js" type="text/javascript"></script>
</head>
<body>
	<div class="aw-top-menu-wrap">
		<div class="container">
			<!-- logo -->
			<div class="aw-logo hidden-xs">
				<a href="index.php"></a>
			</div>
			<div class="aw-search-box  hidden-xs hidden-sm">
				<form class="navbar-search" action="index.php?a=search" id="global_search_form" method="post">
					<input class="form-control search-query" type="text" placeholder="搜索问题、话题或人" autocomplete="off" name="q" id="aw-search-query">
					<span title="搜索" id="global_search_btns" onclick="$('#global_search_form').submit();"><i class="icon icon-search"></i></span>
				</form>
			</div>
			<!-- end logo -->
			<!-- 用户栏 -->
			<?php if(isset($userList)){ ?>
				<!-- 用户栏 -->
				<div class="aw-user-nav">
					<!-- 登陆&注册栏 -->
					<a href="index.php?a=user" class="aw-user-nav-dropdown">
						<img style="width:32px;height:32px;" src="<?php echo !empty($userList['head'])?$userList['head']:'static/img/avatar-max-img.png'; ?>" />
					</a>
					<div class="aw-dropdown dropdown-list pull-right">
						<ul class="aw-dropdown-list">
							<li class="hidden-xs"><a href="index.php?a=userinfo"><i class="icon icon-setting"></i> 编辑</a></li>
							<li><a href="index.php?a=logout"><i class="icon icon-logout"></i> 退出</a></li>
						</ul>
					</div>
					<!-- end 登陆&注册栏 -->
				</div>
				<!-- end 用户栏 -->
				<!-- 发起 -->
				<div class="aw-publish-btn">
					<a id="header_publish" href="index.php?a=add" class="btn-primary"><i class="icon icon-ask"></i>发贴</a>
				</div>
			<?php }else{ ?>
				<!-- end 发起 -->
				<div class="aw-user-nav">
					<!-- 登陆&注册栏 -->
					<span>
						<a class="register btn btn-normal btn-success" href="index.php?a=reg">注册</a>
						<a class="login btn btn-normal btn-primary" href="index.php?a=login">登录</a>
					</span>
					<!-- end 登陆&注册栏 -->
				</div>
				<!-- end 用户栏 -->
			<?php } ?>
		</div>
	</div>