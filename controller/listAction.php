<?php
/**
 * 首页模板
 */
//1.加载公共函数库
include 'controller/function.php';
//5.设置模板名称
$tplName = 'list_tpl';
//2.获取当前帖子的分页数据
if($_POST){
	$bbsOrder = 'ORDER BY `add_time` DESC ';  //设置帖子最新排序
	$bbsWhere =	'WHERE status = 1 AND bbs_title like "%'.$_POST['q'].'%"';	//搜索条件
	$limit    = 0; //组装limit
}else{
	$page = isset($_GET['page']) ? (int)($_GET['page']) : 1;	//获取当前页面
	$bbsType = isset($_GET['type']) ? (int)($_GET['type']) : 1;	//获取类型（1最新 2热门）
	if($bbsType == 1){
		$bbsOrder = 'ORDER BY `add_time` DESC ';				//设置帖子最新排序
	}else if($bbsType == 2){
		$bbsOrder = 'ORDER BY `is_hot` DESC,`add_time` DESC';	//设置帖子热门排序
	}
	$bbsWhere	=	'WHERE status = 1';	//搜索条件
	$limit = ($page-1)*$num;			//第几页，第一个数据是0开始，0*10=0
	$limit = $limit.','.$num;			//组装limit
}
$list  = select($bbsTable,$db,$bbsWhere,$bbsOrder,$limit);	//搜索帖子数据
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
//3.组装分页html
if(!$_POST){
	$count_number	=	count_number($bbsTable,$db,$bbsWhere);
	$number 	=	ceil($count_number/$num);
	$bbsListPage = '';
	for($p=1;$p<=$number;$p++){
		if($p == $page){
			$bbsListPage .= '<li class="active"><a href="';
		}else{
			$bbsListPage .= '<li><a href=" ';
		}
		$bbsListPage .= 'index.php?a=list&page='.$p.'&type='.$bbsType;
		$bbsListPage .= '">';
		$bbsListPage .= $p;
		$bbsListPage .= '</a></li>';
	}
}

//4.获取右侧对应的热门帖子
$bbsWhere = ' WHERE status = 1 AND is_hot=1';
$bbsOrder = ' ORDER BY `is_hot` DESC,`add_time` DESC';
$listHot  = select($bbsTable,$db,$bbsWhere,$bbsOrder,10);
if($listHot){
	foreach($listHot as $k=>$v){
		$bbsListHot[$k]	=	array(
			'bbs_title'	=>	$v['bbs_title'],
			'url'		=>	$url.'?a=details&id='.$v['bbs_id'],
		);
	}
}
//6.如果登录了，获取用户信息
// session_start();
if(isset($_SESSION['user'])){
	$userList	=	$_SESSION['user'];
}
