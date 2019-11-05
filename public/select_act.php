<?php
//接收传过来的GET参数

include 'function.php';

$act = $_GET;

switch ($act['act'])
{
    //渲染登录模板
    case 'login':
        //给登录模板头部导航准备数据[分类信息]
        $conn = db_connect($db);
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($catTable, $conn,'',$order);
        $tplName = 'login_tpl'; //设置登录模板名称:login
        break;

    //登录验证
    case 'check_login':
        $username = $_POST['username'];
        //如果没有没有输入密码,默认应该设置为null,不能设置为空字符,因为空字符也是字符,也算是密码
        $password = $_POST['password'];

        //获取用户信息
        $conn = db_connect($db);
        $userList = do_user_select($userTable, $conn);

        check_login($username,$password, $userList); //管理员验证
        break;

    //退出登录
    case 'logout':
        logout(); //退出不需要模板,直接执行对应函数
        break;

/*******************以下为分类管理*******************/

    //后台分类管理首页
    case 'cat_manage':
        //获取全部分类信息
        $conn = db_connect($db);
        $catList = do_cat_select($catTable, $conn);
        $tplName = 'cat_manage_tpl'; //设置分类管理模板名称
        break;

    //渲染添加分类模板
    case 'cat_insert':
        //给顶部导航赋值
        $conn = db_connect($db);
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($catTable, $conn,'',$order);
        $tplName = 'cat_insert_tpl'; //设置添加分类模板名称
        break;

    //执行分类添加操作
    case 'do_cat_insert':
        $conn = db_connect($db); //连接到数据库
        do_cat_insert($catTable,$conn);
        break;

    //渲染编辑分类模板
    case 'cat_edit':
        $conn = db_connect($db);
        //给顶部导航赋值
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($catTable, $conn,'',$order);
        $cat_id = $_GET['id'];
        $where = 'WHERE ID='.$cat_id;
        //注意返回的是一个只有一个元素的键名为[0]的二维数组
        $conn = db_connect($db);  //需要重新连接,前面连接已经关闭
        $catCurrent = do_cat_select($catTable, $conn,$where);

        $tplName = 'cat_edit_tpl'; //设置编辑分类模板名称
        break;

    //执行分类编辑操作
    case 'do_cat_edit':
        $conn = db_connect($db); //连接到数据库
        $cat_id = $_GET['id'];
        do_cat_edit($catTable,$conn,$cat_id);
        break;

    //执行删除操作,无模板
    case 'do_cat_delete':
        $conn = db_connect($db); //连接到数据库
        $cat_id = $_GET['id'];
        do_cat_delete($catTable,$conn,$cat_id);
        break;

 /*******************以下为博文管理*******************/

    //后台博文管理首页
    case 'art_manage':
        //1. 获取博文分页数据
        //连接数据库
        $conn = db_connect($db);
        //获取当前显示页数,并强制转为整数,即仅保留整数部分
        $page = isset($_GET['page']) ? (int)($_GET['page']):1;
        //获取分页条件
        $limit = pagination($conn, $artTable,$page, $num);
        //设置博文排序条件
        $order = 'ORDER BY `create_time` DESC ';
        //获取博文分页数据
        $artList = do_art_select($artTable,$conn, $order, $limit);

        //2.获取当前表的总记录数量
        $conn = db_connect($db);
        $result = mysqli_query($conn,"SELECT * FROM `{$artTable}`");
        $count = mysqli_num_rows($result);

        //3. 获取全部分类信息
        $conn = db_connect($db);
        $catList = do_cat_select($catTable, $conn);
        $tplName = 'art_manage_tpl'; //设置分类管理模板名称
        break;

    //渲染添加博文模板
    case 'art_insert':
        //给顶部导航赋值
        $conn = db_connect($db);
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($catTable, $conn,'',$order);
        $tplName = 'art_insert_tpl'; //设置添加分类模板名称
        break;

    //执行博文添加操作
    case 'do_art_insert':
        $conn = db_connect($db); //连接到数据库
        do_art_insert($artTable,$conn);
        break;

    //渲染编辑博文模板
    case 'art_edit':
        $conn = db_connect($db);
        //给顶部导航赋值
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($catTable, $conn,'',$order);
        $art_id = $_GET['id'];  //通过GET方式获取要更新的记录id
        $where = 'WHERE ID='.$art_id;
        //注意返回的是一个只有一个元素的键名为[0]的二维数组
        $conn = db_connect($db);  //需要重新连接,前面连接已经关闭
        $artCurrent = do_art_select($artTable, $conn,$where);
        $tplName = 'art_edit_tpl'; //设置编辑分类模板名称
        break;

    //执行分类编辑操作
    case 'do_art_edit':
        $conn = db_connect($db); //连接到数据库
        $art_id = $_GET['id'];  //通过GET方式获取要更新的记录id
        do_art_edit($artTable,$conn,$art_id);
        break;

    //执行删除操作,无模板
    case 'do_art_delete':
        $conn = db_connect($db); //连接到数据库
        $art_id = $_GET['id'];
        do_art_delete($artTable,$conn,$art_id);
        break;

/*******************以下为用户管理*******************/

//后台用户管理首页
    case 'user_manage':
        //获取用户信息
        $conn = db_connect($db);
        $userList = do_user_select($userTable, $conn);

        //获取全部分类信息
        $conn = db_connect($db);
        $catList = do_cat_select($catTable, $conn);

        $tplName = 'user_manage_tpl'; //设置分类管理模板名称
        break;

    //渲染编辑用户模板
    case 'user_edit':
        $conn = db_connect($db);
        //给顶部导航赋值
        $order = 'ORDER BY `order`';
        $catList = do_cat_select($catTable, $conn,'',$order);

        $user_id = $_GET['id'];  //通过GET方式获取要更新的记录id
        $where = 'WHERE ID='.$user_id;
        //注意返回的是一个只有一个元素的键名为[0]的二维数组
        $conn = db_connect($db);  //需要重新连接,前面连接已经关闭
        $userCurrent = do_user_select($userTable, $conn,$where);
        $tplName = 'user_edit_tpl'; //设置编辑分类模板名称
        break;

    //执行用户编辑操作
    case 'do_user_edit':
        $conn = db_connect($db); //连接到数据库
        $user_id = $_GET['id'];  //通过GET方式获取要更新的记录id
        do_user_edit($userTable,$conn,$user_id);
        break;

}