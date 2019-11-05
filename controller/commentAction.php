<?php
/**
 * 发表评论
 */

//1.加载公共函数库
include 'controller/function.php';

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
	$bbs_id  = $_POST['bbs_id'];
	$content = $_POST['content'];
	$content = htmlspecialchars($content);
	if(!$content){
		echo '<script> alert(\'评论不能为空~~\');javascript:history.back(-1);</script>';
		exit;
	}
	// 获取当前时间戳
	$add_time = time();
	// 创建mysql语句
	$sql = "INSERT INTO {$comTable} VALUES (null,'{$bbs_id}','{$userList['uid']}','{$content}','{$add_time}')";
	// 添加数据
	$id  = insert($db,$sql);
	if($id){
		echo '<script> alert(\'评论成功~~\');location.href=\'/index.php?a=details&id='.$bbs_id.'\';</script>';
		exit;
	}else{
		echo '<script> alert(\'评论失败，请重新尝试~~\');javascript:history.back(-1);</script>';
		exit;
	}
}