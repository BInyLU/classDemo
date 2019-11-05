<?php
/**
 * 发帖模板
 */

//1.加载公共函数库
include 'controller/function.php';

//2.设置模板名称
$tplName = 'add_tpl';

//3.如果登录了，获取用户信息
session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}else{
	echo '<script> alert(\'未登录，请先登录！~~\');location.href=\'/index.php?a=login\';</script>';
	exit;
}

//4.发帖保存
if($_POST){
	$bbs_title = $_POST['bbs_title'];
	$bbs_title = htmlspecialchars($bbs_title);
	if(!$bbs_title){
		echo '<script> alert(\'标题不能为空~~\');javascript:history.back(-1);</script>';
		exit;
	}
	$bbs_content = $_POST['bbs_content'];
	$bbs_content = htmlspecialchars($bbs_content);
	if(!$bbs_content){
		echo '<script> alert(\'内容不能为空~~\');javascript:history.back(-1);</script>';
		exit;
	}
	// 获取当前时间戳
	$add_time = time();
	// 创建mysql语句
	$sql = "INSERT INTO {$bbsTable} VALUES (null,'{$userList['uid']}','{$bbs_title}','{$bbs_content}','{$add_time}',1,0,0)";
	// 添加数据
	$id  = insert($db,$sql);
	if($id){
		echo '<script> alert(\'发帖成功~~\');location.href=\'/index.php\';</script>';
		exit;
	}else{
		echo '<script> alert(\'发帖失败，请重新尝试~~\');javascript:history.back(-1);</script>';
		exit;
	}
}