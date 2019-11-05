<?php
/**
 * 首页模板
 * index.php
 * index.php?page=?
 * 共分四步
 * 1. 加载分共函数库
 * 2. 获取分类数据
 * 3. 获取博文分页数据
 * 4. 获取右边推荐数据
 * 5.获取当前表的总记录数量
 * 6. 加载首页模板文件index_tpl.php
 */

//1.加载公共函数库
include 'function.php';


//2.获取分类信息
//连接数据库
$conn = db_connect($db); //连接数据库
//根据用户自定义的排序规则,注意字段名要加``[esc键]
$order = 'ORDER BY `order`';
//获取满足条件的分类信息,注意返回的是只有一个数组的二维数组,[0]=>Array()
$catList = do_cat_select($catTable, $conn,'',$order);



//3.获取当前博文的分页数据
//连接数据库
$conn = db_connect($db);
//获取当前显示页数,并强制转为整数,即仅保留整数部分
$page = isset($_GET['page']) ? (int)($_GET['page']):1;
//获取分页条件
$limit = pagination($conn, $artTable,$page, $num);
//设置博文排序条件
$artWhere = 'ORDER BY `create_time` DESC ';
//获取博文分页数据
$artList = do_art_select($artTable,$conn, '',$artWhere, $limit);



//4.获取右侧对应的博文数据
//连接数据库
$conn = db_connect($db);
//忽略分页获取全部数据,专用于公共的右侧列表专用
$artListAll = do_art_select($artTable,$conn, $artWhere,'');



//5.获取当前表的总记录数量
$conn = db_connect($db);
$result = mysqli_query($conn,"SELECT * FROM `{$artTable}`");
$count = mysqli_num_rows($result);



//6.设置首页模板名称index
$tplName = 'index_tpl';

