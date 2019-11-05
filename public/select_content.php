<?php
/**
* 内容模板
* index.php?cat=?id=?
* 共分四步
* 1. 加载分共函数库: function.php
* 2. 获取全部分类数据: $catList,用在部导航用
* 3. 获取当前分类的名称: $catName,用在标题与说明
* 4. 获取当前记录的详情: $artCurrent,用在左侧列表
* 5. 获取右边推荐数据: $artListAll: 用在右侧列表
* 6. 加载内容模板: content
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

//3.获取当前分类的名称
foreach ($catList as $cat ) {
    if ($cat['id'] == $_GET['cat']) {
    $catName = $cat['cat_name'];  //$catName是当前分类的名称
    }
}


//4.根据GET查询字符串做为条件,获取当前记录的详情
$conn = db_connect($db);
//全局变量$_SERVER['QUERY_STRING']中是查询字符串,格式:cat=3&id=10,没有'?'号
$queryStr = '?'.$_SERVER['QUERY_STRING'];
//特殊注意查询条件写法,双引号解析出变量之后,再套个外壳单引号,重点是顺序:先解析再套壳
$where = "WHERE `title_url` like '{$queryStr}'";    //查询条件
$artCurrent = do_art_select($artTable,$conn, $where);


//5.获取当前分类下面的推荐信息
$conn = db_connect($db);

//条件1:当前分类,根据cat=?获取
$cat_id = $_GET['cat'];  //获取当前分类id,例如index.php?cat=2
$where1 = 'WHERE cat_id = '.$cat_id; //返回多条,二表是一对多关系

//条件2:右侧显示的应该是推荐信息
$where2 = " AND `recommend` = 1";

$where = $where1.$where2;
$artListAll = do_art_select($artTable,$conn, $where);

//6.加载内容模板
$tplName = 'content_tpl';
