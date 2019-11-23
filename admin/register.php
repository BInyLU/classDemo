<?php
    error_reporting(0);
    require_once '../config.php';
    $link = @mysql_connect(DB_HOST, DB_USER, DB_PASS) or die("数据库连接失败！");
    mysql_select_db(DB_NAME, $link);
	
    switch ($_GET["action"]) {
        case "register": //执行添加注册用户操作
        $sql = "select nickname from users where nickname = '$_POST[nickname]'"; //SQL语句
        $result = mysql_query($sql);    //执行SQL语句
        $num = mysql_num_rows($result); //统计执行结果影响的行数
        
		if ($_POST['email'] == null || $_POST['slug'] == null  || $_POST['nickname']  == null || $_POST['bio']  == null || $_POST['password'] == null  ) {
		    $GLOBALS['message']='请完整填写所有内容';
			// echo "<script>alert('请完整填写所有内容'); history.go(-1);</script>";
		}else{
			// 如果存在用户
			if ($num) {
			    echo "<script>alert('用户名已存在'); history.go(-1);</script>";
			} else {
			    $sql_insert = "insert into users (email,slug,nickname,bio,password,root) values('$_POST[email]','$_POST[slug]','$_POST[nickname]','$_POST[bio]','$_POST[password]','$_POST[root]')";
			    $res_insert = mysql_query($sql_insert);
			    if ($res_insert) {
			        echo "<script>alert('注册成功！');window.location='login.php';</script>";
			    } else {
			        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";
			    }
			}
		}
        break;
    }
    mysql_close($link);
?>

<!DOCTYPE html>
<html lang="zh-CN">
<head>
  <meta charset="utf-8">
  <title>课程研讨平台系统</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="../static/assets/vendors/bootstrap/css/bootstrap.css">
  <link rel="stylesheet" href="../static/assets/css/admin.css">
  <link rel="stylesheet" href="../static/assets/css/login.css">
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/animate/animate.css">
</head>
<body>
	<!-- 头部菜单 -->
	<div class="header">
		<div class="content">
			<div class="nav">
				<ul>
					<li><a href="../"><i class="fa fa-home"></i><span>&nbsp;&nbsp;首页</span></a></li>
					<li><a href="../article"><i class="fa fa-book"></i><span>&nbsp;&nbsp;话题研讨</span></a></li>
					<li><a href="../admin"><i class="fa fa-user"></i><span>&nbsp;&nbsp;个人中心</span></a></li>
					<div class="clear"></div>
				</ul>
			</div>
			<div class="clear"></div>
		</div>
	</div>
	
	<!-- banner背景 -->
	<div class="m-bg-all">
		<div class="m-bg">
			<div class="m-bg-mask m-bg-mask0"></div>
			<div class="m-bg-mask m-bg-mask1"></div>
			<div class="m-bg-mask m-bg-mask2"></div>
			<div class="m-bg-mask m-bg-mask3"></div>
		</div>
	</div>
  <div class="login">
    <form class="login-wrap" action="register.php?action=register" method="post" novalidate autocomplete="off" style="margin: 100px auto;padding: 40px;">
		<?php if (isset($message)): ?>
		   <div class="alert alert-danger">
		  <strong>错误！<?php echo $message ?></strong> 
		</div>
		<?php endif ?>
      <div class="form-group">
		<p>邮箱：</p>
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus value="" required="required">
      </div>
	  <div class="form-group">
	  	<p>英文名：</p>
	    <label for="slug" class="sr-only">英文名</label>
	    <input id="slug" name="slug" type="slug" class="form-control" placeholder="英文名" autofocus value="" required="required">
	  </div>
	  <div class="form-group">
	  	<p>昵称：</p>
	    <label for="nickname" class="sr-only">昵称</label>
	    <input id="nickname" name="nickname" type="nickname" class="form-control" placeholder="昵称" autofocus value="" required="required">
	  </div>
	  <div class="form-group">
	  	<p>简介：</p>
	    <label for="bio" class="sr-only">简介</label>
	    <input id="bio" name="bio" type="bio" class="form-control" placeholder="简介" autofocus value="" required="required">
	  </div>
      <div class="form-group">
		<p>密码：</p>
        <label for="password" class="sr-only">密码</label>
        <input id="password-md"  type="password" class="form-control" placeholder="密码" required="required">
         <input type="hidden" id="password" name="password">
      </div>
	  <div class="form-group">
	  	<p>权限：(默认普通用户)</p>
	    <label for="root" class="sr-only">权限</label>
	    <input id="root" name="root" type="root" class="form-control" placeholder="权限" autofocus value="user" disabled="disabled">
	  </div>
	  <input class="btn btn-primary btn-block" type="submit" name="submit" value="注册" id="button" />  <br>
	  <a href="login.php" class="btn btn-primary " >登 陆</a>
      <a href="../" class="btn btn-primary " >返回首页</a>
    </form>
  </div>
  <div style="height: 100px;"></div>
  <script src="../static/assets/vendors/jquery/jquery.min.js"></script>
  <script src="../static/assets/vendors/jquery/md5.js"></script>
  <script>
    $(function($){
		//1.单独作用域
		//2.确保页面加载后执行
		//  blur 失去焦点
		// $('#email').on('blur',function(){
		// 	 var emailFormat=/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/
		// 	 var value=$(this).val();
		// 	 if (!value || !emailFormat.test(value)) {
		// 	   return;
		// 	}  
		// });
		$('#button').on('click',function(){
			var passwordOld=document.getElementById('password-md');
			var passwordNew=document.getElementById('password');
			console.log(passwordOld.value);
			// set password
			passwordNew.value = hex_md5(passwordOld.value);
		});
		// var www=hex_md5("123")
		// console.log(www);
    });
  </script>
</body>
</html>
