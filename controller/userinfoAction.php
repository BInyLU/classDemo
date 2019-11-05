<?php
/**
 * 修改用户模板
 */

//1.加载公共函数库
include 'controller/function.php';

//2.设置模板名称
$tplName = 'userinfo_tpl';
//3.如果登录，存储用户信息。未登录，跳转到登录页面
session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}else{
	echo '<script> alert(\'未登录，请先登录！~~\');location.href=\'/index.php?a=login\';</script>';
	exit;
}
if($_POST){
	if($_FILES['head']['name']){
		$old_name = $_FILES['head']['name'];      				//图片名
		$old_name = explode('.',$old_name);						//获取后缀
		$new_name = rand(10000,99999);							//随机新图片名
	    $tmp 	  = $_FILES['head']['tmp_name'];  				//图片位置
	    $update   = 'update/head/'.$new_name.'.'.$old_name[1];	//组装路径
	    move_uploaded_file($tmp,$update);						//复制图片
    }else{
    	$update = $userList['head'];
    }
	// 判断账号不能为空上传图片到本站下
	$nickname = $_POST['nickname'];
	if(!$nickname){
		echo '<script> alert(\'昵称不能为空~~\');javascript:history.back(-1);</script>';
		exit;
	}
	// 判断密码不能为空
	$psword = $_POST['psword'];
	if(!$psword){
		echo '<script> alert(\'密码不能为空~~\');javascript:history.back(-1);</script>';
		exit;
	}else{
		$psword = md5($psword);
	}
	// 修改用户信息
	$value = 'nickname="'.$nickname.'",psword="'.$psword.'",head="'.$update.'"';
	$where = 'uid='.$userList['uid'];
	$save = save($userTable,$db,$value,$where);
	if($save){
		$_SESSION['user']['nickname']	=	$nickname;
		$_SESSION['user']['psword']	=	$psword;
		$_SESSION['user']['head']	=	$update;
		echo '<script> alert(\'修改成功~~\');javascript:history.back(-1);</script>';
		exit;
	}else{
		echo '<script> alert(\'修改失败，请重新尝试~~\');javascript:history.back(-1);</script>';
		exit;
	}
}