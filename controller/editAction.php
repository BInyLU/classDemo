<?php
/**
 * 发帖模板
 */

//1.加载公共函数库
include 'controller/function.php';

//2.设置模板名称
$tplName = 'edit_tpl';

//3.如果登录了，获取用户信息
session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}else{
	echo '<script> alert(\'未登录，请先登录！~~\');location.href=\'/index.php?a=login\';</script>';
	exit;
}

if($_POST){
	if(empty($_POST['id'])){
		echo '<script> alert(\'未找到帖子，请重试！~~\');javascript:history.back(-1);</script>';
		exit;
	}
	//4.修改帖子
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
	// 修改数据
	$value = 'bbs_title="'.$bbs_title.'",bbs_content="'.$bbs_content.'"';
	$bbsWhere = 'bbs_id='.$_POST['id'];
	$id  = save($bbsTable,$db,$value,$bbsWhere);
	if($id){
		echo '<script> alert(\'修改成功~~\');location.href=\'/index.php?a=user\';</script>';
		exit;
	}else{
		echo '<script> alert(\'修改失败，请重新尝试~~\');javascript:history.back(-1);</script>';
		exit;
	}
}else{
	if(empty($_GET['id'])){
		echo '<script> alert(\'未找到帖子，请重试！~~\');javascript:history.back(-1);</script>';
		exit;
	}
	//4.查询帖子
	$details = find($bbsTable,$db,'bbs_id',$_GET['id']);
}