<?php
/**
 * 删除帖子、设置热门帖子
 */

//1.加载公共函数库
include 'controller/function.php';

//2.如果登录了，获取用户信息
session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}else{
	echo '<script> alert(\'未登录，请先登录！~~\');location.href=\'/index.php?a=login\';</script>';
	exit;
}
if(empty($_GET['id'])){
	echo '<script> alert(\'未找到帖子~~\');javascript:history.back(-1);</script>';
	exit;
}
if($_GET['o'] == 'del'){
	$bbsWhere	=	'WHERE bbs_id = '.$_GET['id'];
	$oper = delete($bbsTable,$db,$bbsWhere);
}else if($_GET['o'] == 'hot'){
	$bbsWhere	=	'bbs_id = '.$_GET['id'];
	$value = 'is_hot=1';
	$oper = save($bbsTable,$db,$value,$bbsWhere);
}else if($_GET['o'] == 'nhot'){
	$bbsWhere	=	'bbs_id = '.$_GET['id'];
	$value = 'is_hot=0';
	$oper = save($bbsTable,$db,$value,$bbsWhere);
}
if($oper){
	echo '<script> alert(\'成功~~\');javascript:history.back(-1);</script>';
	exit;
}else{
	echo '<script> alert(\'失败，请重试~~\');javascript:history.back(-1);</script>';
	exit;
}