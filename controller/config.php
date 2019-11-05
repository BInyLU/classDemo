<?php
/**
 * 命名规范:变量采用驼峰命名法,方法采用小写字母加下划线命名法
 * 全站要求:可配置,可扩展
 * 全部url采用全动态生成,约定a代表模块,page代表分页
 * 入口地址统一为: index.php?a=模块,例如:index.php?a=list
 */
header("Content-type: text/html; charset=utf-8");
//设置中国时区
date_default_timezone_set('PRC');
//域名
$url = 'https://kbnvlf.coding.io/index.php';
//设置每页显示信息数量
$num = 10;
//设置页面标题后缀
define('SITE_SUFFIX','demo');

//设置数据库连接参数
$db = array(
    'db_host' => 'localhost',
    'db_user' => 'user-nnfpQ9KK2z',
    'db_pass' => 'n_QQ9c]SKXgeqcOs{wks',
    'db_name' => 'db-eYPQ9bNIXb'
);

//设置用到的数据表
$bbsTable  = 'forum_bbs';    //帖子
$comTable  = 'forum_comment';//评论
$userTable = 'forum_user';   //用户

//加载模板选择脚本
$getNo = isset($_GET['a']) ? $_GET['a'] : 'list';
switch ($getNo)
{
    case 'login':   //登录
        include 'loginAction.php';break;
    case 'reg':     //注册
        include 'regAction.php';break;
    case 'logout':  //退出登录
        session_start();
        if (session_destroy()){
            echo "<script>location.href='/index.php';</script>";
        }
        break;
    case 'user':     //个人中心
        include 'userAction.php';break;
    case 'userinfo': //修改用户资料
        include 'userinfoAction.php';break;
    case 'list':    //列表
        include 'listAction.php';break;
    case 'search':
        include 'searchAction.php';break;
    case 'details': //详情
        include 'detailsAction.php';break;
    case 'comment': //评论
        include 'commentAction.php';break;
    case 'add':     //发帖
        include 'addAction.php';break;
    case 'edit':    //修改发帖
        include 'editAction.php';break;
    case 'oper':    //删除帖子、设置热门帖子
        include 'operAction.php';break;
    default:
        echo '<script> alert(\'参数错误~~\');location.href=\'/index.php\';</script>';
}