<?php
/**
 * 详情模板
 */

//1.加载公共函数库
include 'controller/function.php';
//10.设置模板名称
$tplName = 'details_tpl';

//2.获取帖子参数
$id = isset($_GET['id']) ? (int)($_GET['id']):0;
if($id == 0){
	echo '<script> alert(\'参数错误~~\');location.href=\'/index.php\';</script>';
}

//3.增加帖子浏览量
$value = 'browse=browse+1';
$where = 'bbs_id='.$id;
save($bbsTable,$db,$value,$where);

//4.获取帖子详情
$details = find($bbsTable,$db,'bbs_id',$id);
if(!$details){
	echo '<script> alert(\'未找到详情！~~\');location.href=\'/index.php\';</script>';
}else{
	$details['add_time']	=	date('Y-m-d H:i',$details['add_time']);
}

//5.获取右侧发起人
$pUserList 	= find($userTable,$db,'uid',$details['uid']);

//6.获取右侧对应的热门帖子
$bbsWhere	= ' WHERE status = 1 AND is_hot=1';
$bbsOrder   = ' ORDER BY `is_hot` DESC,`add_time` DESC';
$listHot = select($bbsTable,$db,$bbsWhere,$bbsOrder,10);
if($listHot){
	foreach($listHot as $k=>$v){
		$bbsListHot[$k]	=	array(
			'bbs_title'	=>	$v['bbs_title'],
			'url'		=>	$url.'?a=details&id='.$v['bbs_id'],
		);
	}
}

//7.如果登录，存储用户信息。未登录，跳转到登录页面
session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}

//8.获取评论
$comWhere = ' WHERE bbs_id = '.$id;
$comOrder = ' ORDER BY `add_time` DESC';
$page  = isset($_GET['page']) ? (int)($_GET['page']):1;		//获取当前页面

$limit = ($page-1)*$num;			//第几页 0*10 = 0
$limit = $limit.','.$num;			//组装limit 0,10

$comment  = select($comTable,$db,$comWhere,$comOrder,$limit);
if($comment){
	foreach($comment as $com_k=>$com_v){
		$comment[$com_k]['nickname'] = find_one($userTable,$db,' WHERE uid='.$com_v['uid'],'nickname');
		$comment[$com_k]['head'] = find_one($userTable,$db,' WHERE uid='.$com_v['uid'],'head');
	}
	unset($com_v,$com_k);
}

//9.组装分页html
$count_number	=	count_number($comTable,$db,$comWhere);
$number 	 =	ceil($count_number/$num);
$bbsListPage = '';
for($p=1;$p<=$number;$p++){
	if($p == $page){
		$bbsListPage .= '<li class="active"><a href="';
	}else{
		$bbsListPage .= '<li><a href="';
	}
	$bbsListPage .= 'index.php?a=details&id='.$id.'&page='.$p;
	$bbsListPage .= '">';
	$bbsListPage .= $p;
	$bbsListPage .= '</a></li>';
}