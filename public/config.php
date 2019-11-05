<?php
/**
 * 命名规范:变量采用驼峰命名法,函数采用小写字母加下划线命名法
 * 全站要求:可配置,可扩展
 * 全部url采用全动态生成,约定cat代表分类,act代表操作
 * 全站为个人博客,首页与分类模板相同,仅调用数据不同,首页为全部数据,分类页为分类数据
 * 分类的入口地址统一为: index.php?act=分类id,例如:index.php?act=2
 * 博文的入口地址统一为: index.php?act=分类id&id=博文id,例如:index.php?cat=2&id=10
 */

//设置站点名称
$siteName = 'Biny blog';
//禁用错误报告
error_reporting(0);
//设置编码格式
header("Content-type: text/html; charset=utf-8");

//设置页面标题后缀
define('SITE_SUFFIX',' ');



//设置数据库连接参数
$db = [
    'db_host' => 'mysql.coding.io',
    'db_user' => 'user-nnfpQ9KK2z',
    'db_pass' => 'n_QQ9c]SKXgeqcOs{wks',
    'db_name' => 'db-eYPQ9bNIXb'
];




//设置用到的数据表
$catTable = 'blog_category'; //分类表
$artTable = 'blog_article'; //博文表
$userTable = 'blog_user'; //用户表



//设置每页显示信息数量
$num = 10;



//加载模板选择脚本
$getNo = isset($_GET) ? count($_GET) : 0;
switch ($getNo)
{
    case 0:
        include 'select_index.php';break;
    case 1:
    case 2:
    case 3:
        //array_keys()返回数组键名组成的数组
        $get = array_keys($_GET);
        switch ($get[0])
        {
            //加载首页模板
            case 'page':
                include 'select_index.php';break 2;  //2:跳到最外层返回
            case 'cat':
                //如果get键名数组中存在id,则加载内容模板
                if (in_array('id',$get)) {
                    include 'select_content.php';break 2;
                }
                //当前get键名为cat,则加载分类模板
                include 'select_cat.php';break 2;

            //当前键名为act加载后台管理模板
            case 'act':
                include 'select_act.php';break 2;
        }
        break;

    default:
        echo '<script> alert(\'参数错误~~\');location.href=\'/index.php\';</script>';

}





