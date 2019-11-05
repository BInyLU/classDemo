<?php  include 'public/config.php'; //加载全局配置文件 ?>
<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
			h1,h2,h3,h4,h5,h6,p,a,li,span{
				font-family: "Exo 2", "Trebuchet MS","Helvetica","Arial",'PingFang SC','Hiragino Sans GB','STHeiti Light','Microsoft YaHei','SimHei','WenQuanYi Micro Hei',sans-serif !important;
			}
			p,a,li,span{
				letter-spacing: 1px;
			}
			.panel-default {
					border-color: #fff !important;
			}
			.panel-default>.panel-heading{
				background-color: #fff !important;
			}
			h2{
				text-shadow: 2px 2px 10px rgba(0,0,0,.2);
			}
			h4{
				font-size: 1.5em !important;
				color: #444 !important;
				font-weight: 700;
			}
			h4 a{
				font-weight: 700;
				line-height: 150%;
				transition: all .2s;
			}
			h4 a::before {
					content: '';
					position: absolute;
					left: 10px;
					width: 3px;
					height: 16px;
					margin-top: 10px;
					background: #f45a6f;
			}
			h4 a:hover{
				text-decoration: none;
				color: #f45a6f;
			}
			.panel-body{
				border-top: none !important;
			}
			.navbar-nav>.active>a {
				background-color: #fff !important;
				color: #333 !important;
				border: solid #666 1px;
			}
			.navbar-nav a:hover{
				color: #000 !important;
			}
			.navbar-brand:hover{
				color: #333 !important;
			}
			.navbar-nav>li>a{
				color: #333 !important;
			}
			.navbar-nav{
				float: none !important;
				margin: 0 auto !important;
				width: 50% !important;
			}
			.head {
					border-radius: 10px;
					margin: 40px;
			}
			.navbar-header{
				float: none !important;
				text-align: center !important;
			}
			.panel-default{
				margin-bottom: 50px !important;
			}
			p{
				line-height: 200% !important;
				margin: 0 0 20px !important;
			}
			.xian{
				width: 100%;
				height: 4px;
				background: #444;
			}
			.navbar-inverse,.navbar-default{
				border: none !important;
				background-color: rgba(0,0,0,.0001) !important;
			}
			.row {
				margin-right: 0 !important;
				margin-left: 0 !important;
			}
			.col-md-10{
				margin: 0 auto !important;
				float: none !important;
			}
			.btn-info:hover {
					background-color: #fff !important;
					border-color: #424242 !important;
					color: #333 !important;
			}
			.btn-info {
				float: right;
				padding: 6px 10px;
				background-color: #424242 !important;
				border-color: #424242 !important;
				transition: all .2s ease-in-out;
			}
			.btn-xs{
				padding: 6px 10px !important;
			}
			#text{
				float: none;
				font-size: 3em;
				line-height: 110px;
				color: #666;
				text-shadow: 10px 10px 4px rgba(51,51,51,.4);
				letter-spacing: 5px;
			}
			#text::before {
					content: '';
					position: absolute;
					bottom: 20px;
					width: 5%;
					height: 3px;
					background: #777;
					transition: all 0.3s ease;
			}
		</style>

    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
    <title>
        <?php

        if (isset($_GET)){
            if (array_key_exists('cat',$_GET)) {
                echo strtoupper($catName).SITE_SUFFIX;
            } elseif (array_key_exists('act',$_GET)){
                echo '后台管理'.SITE_SUFFIX;
            }
        } else {
            echo '首页'.SITE_SUFFIX;
        }
        ?>
    </title>

    <!-- Bootstrap -->
    <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--引入wangeditor的css文件-->
    <link rel="stylesheet" type="text/css" href="/lib/wangeditor/dist/css/wangEditor.min.css">

</head>
<body>
										<!-- 线条 -->
										<div class="xian"></div>
										<div class="container">
												<!--顶部菜单-->
												<div class="row head shadow" id="header">
														<div class="col-md-12">
																<nav class="navbar navbar-default navbar-static-top navbar-inverse">
																		<div class="container-fluid">
																				<!-- Brand and toggle get grouped for better mobile display -->
																				<div class="navbar-header">
																				<!--<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
																										data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
																								<span class="sr-only">Toggle navigation</span>
																								<span class="icon-bar"></span>
																								<span class="icon-bar"></span>
																								<span class="icon-bar"></span>
																						</button> -->
																						<a class="navbar-brand" href=""  id="text"><?php echo $siteName; ?></a>
																				</div>
																		</div><!-- /.container-fluid -->
																</nav>
														</div>
																								<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" >
																										<ul class="nav navbar-nav">
																												<li><a href="">首页</a></li>
																												<?php foreach ($catList as $cat) :?>
																												<li><a href="<?php echo $cat['cat_url'];?>"><?php echo $cat['cat_name'];?></a></li>
																												<?php endforeach; ?>
																										</ul>
														
																									<!-- 如果用户登陆,显示出用户名和相关操作-->
																										<?php if (isset($_SESSION['username']) && $_SESSION['username']=='admin'):?>
																										<ul class="nav navbar-nav navbar-right">
																												<li><a href="#"><?php echo $_SESSION['username'] ?></a></li>
																												<li class="dropdown">
																														<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
																															aria-expanded="false">操作<span class="caret"></span></a>
																														<ul class="dropdown-menu">
																																<li><a href="/index.php?act=cat_manage">分类管理</a></li>
																																<li><a href="/index.php?act=art_manage">博文管理</a></li>
																																<li><a href="/index.php?act=user_manage">用户管理</a></li>
																																<li role="separator" class="divider"></li>
																																<li><a href="" onclick="logout();return false;">退出</a></li>
																														</ul>
																												</li>
																										</ul>
																												<?php else: ?>
																										<ul class="nav navbar-nav navbar-right" style="display: none;">
																												<li><a href="/index.php?act=login">登录</a></li>
																										</ul>
																										<?php endif;?>
																								</div><!-- /.navbar-collapse -->
												</div>


		
    <script>
        function logout() {
            if (confirm('确定退出吗?')){
                window.location.href='/index.php?act=logout';
            } else {
                window.location.href='/index.php';
            }
        }
    </script>


		<script>
			var text = document.querySelector('#text');

				function getLongShadow(startColor = '212,213,213', shadowLength = 12, ratioX = 1, ratioY = 1) {
						let textShadow = '';
						let alpha;
						let color;
						let seperator = ',';

						for (let i = 0.5; i <= shadowLength; i=i+0.5) {
								alpha = (1 - (i - 0.5) / shadowLength) * 0.6;
								color = `rgba(${startColor}, ${alpha})`;
								if (i === shadowLength) {
										seperator = '';
								}
								textShadow += `${i * ratioX}px ${i * ratioY}px ${color}${seperator}`;
						}
						return textShadow;
				}

				text.style.textShadow = getLongShadow('212,213,213',8,1,1);

				let rect = text.getBoundingClientRect();
						let focus = { x: rect.left, y: rect.top };
						let mouse = { x: 0, y: 0 };
						let width = (window.innerWidth - focus.x) * 3 / 4;
						let height = (window.innerHeight - focus.y) * 3 / 4;
						let ratioX;
						let ratioY;
						window.addEventListener('mousemove', function (ev) {
								mouse.x = ev.clientX;
								mouse.y = ev.clientY;
								ratioX = (mouse.x - focus.x) / width;
								ratioY = (mouse.y - focus.y) / height;
								text.style.textShadow = getLongShadow('212,213,213', 10, ratioX, ratioY);
						});

		</script>