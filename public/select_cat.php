<?php
/**
 * 分类模板
 * index.php?cat=?
 * 共分四步
 * 1. 加载分共函数库: function.php
 * 2. 获取全部分类数据: $catList,用在部导航用
 * 3. 获取当前分类的名称: $catName,用在标题与说明
 * 4. 获取博文分页数据: $artList,用在左侧列表
 * 5. 获取右边推荐数据: $artListAll: 用在右侧列表
 * 6.获取当前表当前分类的总记录数量
 * 7. 加载分类模板文件:其实与首页共用: index
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



//4.获取当前博文的分页数据
//连接数据库
$conn = db_connect($db);
//获取当前显示页数,并强制转为整数,即仅保留整数部分
$page = isset($_GET['page']) ? (int)($_GET['page']):1;
//获取分页条件
$limit = pagination($conn, $artTable,$page, $num);
//设置博文排序条件
$order = 'ORDER BY `create_time` DESC ';
//设置博文分类查询条件cat_id
$where = "WHERE `cat_id` = {$_GET['cat']}";
//获取博文分页数据
$artList = do_art_select($artTable,$conn, $where,$order, $limit);



//5.获取当前分类下面的推荐信息
$conn = db_connect($db);
//条件1:当前分类,根据cat=?获取
$cat_id = $_GET['cat'];  //获取当前分类id,例如index.php?cat=2
$where1 = 'WHERE cat_id = '.$cat_id; //返回多条,二表是一对多关系
//条件2:右侧显示的应该是推荐信息
$where2 = " AND `recommend` = 1";
//执行查询操作
$where = $where1.$where2;
$artListAll = do_art_select($artTable,$conn, $where);



//6.获取当前表当前分类的总记录数量,分页与首页记录总数可不一样,一定要注意哟~~
$conn = db_connect($db);
$where = isset($_GET) ? 'WHERE `cat_id`='.$_GET['cat'] : '';
$result = mysqli_query($conn,"SELECT * FROM `{$artTable}` {$where}");
$count = mysqli_num_rows($result);



//7.设置首页模板名称index
$tplName = 'index_tpl';