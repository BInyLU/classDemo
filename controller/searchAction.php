<?php
/**
 * 搜索模板
 */
//1.加载公共函数库
include 'controller/function.php';
//5.设置模板名称
$tplName = 'search_tpl';
//2.获取当前帖子的分页数据
if(!empty($_POST)){
	$bbsOrder = 'ORDER BY `add_time` DESC ';  //设置帖子最新排序
	$bbsWhere =	'WHERE status = 1 AND bbs_title like "%'.$_POST['q'].'%"';	//搜索条件
	$list  = select($bbsTable,$db,$bbsWhere,$bbsOrder);	//搜索帖子数据
	if($list){
		foreach($list as $k=>$v){
			$bbsList[$k]	=	array(
				'bbs_id'	=>	$v['bbs_id'],
				'uid'		=>	$v['uid'],
				'bbs_title'	=>	$v['bbs_title'],
				'nickname'	=>	find_one($userTable,$db,'WHERE uid='.$v['uid'],'nickname'),
				'head'		=>	find_one($userTable,$db,'WHERE uid='.$v['uid'],'head'),
				'browse'	=>	$v['browse'],
				'add_time'	=>	date('Y-m-d H:i',$v['add_time']),
				'url'		=>	$url.'?a=details&id='.$v['bbs_id'],
			);
		}
	}
}
//6.如果登录了，获取用户信息
session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}