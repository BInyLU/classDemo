<?php 
//载入配置文件
require_once '../config.php';

//给用户找一个箱子，如果之前有，就用之前的，没有就给个新的
session_start();
function login(){
  //接受并校验
  //持久化
  //响应
  if (empty($_POST['email'])) {
    $GLOBALS['message']='请填写邮箱';
    return;
  }
  if (empty($_POST['password'])) {
    $GLOBALS['message']='请填写密码';
    return;
  }
  $email=$_POST['email'];
  $password=$_POST['password'];



  //连接数据库校验
 $conn=mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
  if (!$conn) {
    exit('<h1>数据库连接失败</h1>');
  }
  $query=mysqli_query($conn,"select * from users where email = '{$email}' limit 1; ");

  if ( !$query) {
     $GLOBALS['message']='登录失败，请重试';
    return;
  }
  $user=mysqli_fetch_assoc($query);
  if (!$user) {
    //用户名不存在，但是提示邮箱密码不匹配
    $GLOBALS['message']='邮箱与密码不匹配1';
    return;
  }
  if ($user['password']!==$password) {
    //密码不正确
    $GLOBALS['message']='邮箱与密码不匹配2';
    return;
  }
  //存一个登录标识
  //$_SESSION['is_logged_in']=true;
  $_SESSION['current_login_user']=$user;


  //到这里了就可以跳转了
  if ($user['root']=='root') {
     header('Location: index.php');
  } 
  if ($user['root']=='user' || $user['root']=='') {
     header('Location: index.php');
   }
 
}
if ($_SERVER['REQUEST_METHOD']==='POST') {
  login();
}
if ($_SERVER['REQUEST_METHOD']==='GET' && isset($_GET['action']) && $_GET['action']==='logout') {
   if (!empty($_SESSION['current_login_user'])) {
     session_unset($_SESSION['current_login_user']);
   } 
}

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
  <link rel="stylesheet" href="../static/assets/vendors/font-awesome/css/font-awesome.css">
  <link rel="stylesheet" href="../static/assets/vendors/animate/animate.css">
  <link rel="stylesheet" href="../static/assets/css/login.css">
</head>
<style>

</style>
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
    <!-- 可以通过在form上添加novalidate取消浏览器自带的校验功能 -->
    <!-- autocomplete="off" 关闭客户端的自动完成功能 -->
    <form class="login-wrap <?php echo isset($message) ? 'shake animated' : '' ?>" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" novalidate autocomplete="off">
      <img class="avatar" src="../static/assets/img/default.png">
      <!-- 有错误信息时展示 -->
      <?php if (isset($message)): ?>
         <div class="alert alert-danger">
        <strong>错误！<?php echo $message ?></strong> 
      </div>
      <?php endif ?>
     
      <div class="form-group">
        <label for="email" class="sr-only">邮箱</label>
        <input id="email" name="email" type="email" class="form-control" placeholder="邮箱" autofocus value="<?php echo isset($_POST['email'])? $_POST['email'] :''  ?>">
      </div>
      <div class="form-group">
        <label for="password" class="sr-only">密码</label>
        <input id="password-md"  type="password" class="form-control" placeholder="密码">
         <input type="hidden" id="password" name="password">
      </div>
      <button class="btn btn-primary btn-block" id="button">登 录</button><br>
	  <a href="register.php" class="btn btn-primary " >注 册</a>
      <a href="../" class="btn btn-primary " >返回首页</a>
    </form>
  </div>
  <div style="height: 100px;"></div>
  <script src="../static/assets/vendors/jquery/jquery.min.js"></script>
  <script src="../static/assets/vendors/jquery/md5.js"></script>
  <script>
 //    $(function($){
	// 	// $('#email').on('blur',function(){
	// 	//  var emailFormat=/^[a-zA-Z0-9]+@[a-zA-Z0-9]+\.[a-zA-Z0-9]+$/
	// 	//  var value=$(this).val();
	// 	//  if (!value || !emailFormat.test(value)) {
	// 	//    return;
	// 	// }  
 //  //   //因为客户端的JS无法直接操作数据库，应该通过JS发送AJAX请求告诉服务端某个端口
 //    //让这个接口帮助客户端获取头像地址
 //    //{email:value} 传到接口的数据
 //    $.get('api/avator.php',{ email : value }, function(res) {
 //      //希望res能拿到邮箱对应的地址
 //      if (!res) return;
 //      //希望展示到上面的img元素上
 //      $('.avatar').fadeOut( function() {
 //        $(this).on('load',function() {
 //         $(this).fadeIn();
 //        }).attr('src', '..' + res);
 //      });;
      
 //    });

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
    // });
  </script>
</body>
</html>
