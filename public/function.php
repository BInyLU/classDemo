<?php


/* 模板统一自动加载函数
 * @param $tplName 模板名称
 * 返回值是要加载的模板文件
 */
function auto_load_tpl($tplName)
{
    /**
     * 模板变量注册
     * global ,相当于对全局变量的【同名引用】: $a=10; function func(&$a){ echo $a; } 结果:10
     * 所谓同名引用是说:函数内部的局部变量与外部全局变量同名,上一行用global关键字改写
     * $a=10; function func(){ global $a;  echo $a; } 结果:10
     * $GLOBALS['全局变量名'],通过全局变量数组直接使用外部全局变量,就像在函数定义的变量一样。
     */
    //
    //1. 分类相关变量
    global $catList; //全部分类信息$catListAll[二维数组]
    global $catCurrent; //当前分类信息
    global $catName; //当前分类名称

    //以上global 外部同名变量;  替代语句:
    //例如:  $catName = isset($catName)?$catName:null;
    //为什么要用null,因为外部变量无非二种情况,要么存在且有值,要么根本没有创创建,自动赋null值
    

    //2. 博文相关变量
    global $artList; //博文分页内容$artList[二维数组]
    global $artListAll; //全部博文信息(忽略分页)$artListAll[二维数组]
    global $artCurrent; //当前博文信息$artCurrent,获取
    global $count;  //博文总页数,用于分页控制
    global $num; //每页显示的记录数量

    //3. 用户相关变量
    global $userList; //引用外部变量$userList,获取当前用户信息
    global $userCurrent; //引用外部变量$userCurrent,获取当前用户信息,其实与$userList一样,分开是为扩展性,方便增加用户

    //自动加载模板
    include 'public/tpl/'.$tplName.'.php';
}

/************************登录相关操作*************************/

//登录操作
function check_login($username, $password, $userList)
{
    if (empty($username) || empty($password) ){
        echo '<script> alert("用户名和密码不能为空");location.href="/index.php?act=login";</script>';
    }

    if($username == $userList[0]['username'] && md5($password) == $userList[0]['password']) {
        //登录成功,将用户名写入session,用来判断用户管理权限
        $_SESSION['username'] = $username;
        echo '<script> alert("登录成功~~");location.href="/index.php";</script>';
    } else {
        echo '<script> alert("登录失败,请检查用户名或密码~~");location.href="/index.php?act=login";</script>';
    }
}

//退出登录
function logout(){
 if (session_destroy()) {
     echo "<script>location.href='/index.php';</script>";
 }
}


//连接数据库
function db_connect($db)
{
    // 创建连接
    $conn = mysqli_connect($db['db_host'], $db['db_user'], $db['db_pass'],$db['db_name']);

    // 检测连接
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    return $conn;
}

/************************分类管理相关操作*************************/

//查询分类表blog_category中记录
function do_cat_select($table,$conn,$where='',$order='')
{
    $sql = 'SELECT * FROM '.$table.' '.$where.' '.$order;
    $rows=[];
    if ($result = mysqli_query($conn, $sql)) {

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[]=$row;
        }
    mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $rows;

}

//新增分类表blog_category中记录
function do_cat_insert($table, $conn)
{
    $catName = $_POST['cat_name'];  //分类名称
    $order = $_POST['order'];       //分类自定义排序
    $catUrl = '?cat=';       //分类链接,后面要拼接新增的记录主键id
    $createTime = time();    //创建时间
    $updateTime = time();    //更新时间

    //创建插入SQL语句,插入新值要与记录字段的顺序,类型完全一致,字符型必须加引号
    $sql = "INSERT INTO {$table} VALUES (null,'{$catName}',{$order},'{$catUrl}',{$createTime},{$updateTime})";

    //执行插入操作
    if (mysqli_query($conn, $sql)){
        //只有插入成功后才可以获取新增主键id
        $insert_id = mysqli_insert_id($conn);
        //为更新当前分类链接字段cat_url,创建更新语句,将新增ID拼接到当前字段值的后面
        $updateUrl = "update {$table} set `cat_url`='{$catUrl}{$insert_id}' where `id`={$insert_id}";
        mysqli_query($conn,$updateUrl);  //执行cat_url字段的更新操作,必须根据id更新,否则会更新全部cat_url
        echo '<script> alert("添加成功!");location.href="/index.php?act=cat_manage";</script>';  //更新成功提示
    } else {
        echo '<script> alert("添加失败");history.back();</script>';  //更新失败提示
    }
}

//更新分类表blog_category中记录
function do_cat_edit($table, $conn, $id)
{
    $catName = $_POST['cat_name'];
    $order = $_POST['order'];
    $updateTime = time();

    $sql = "UPDATE {$table} SET `cat_name`='{$catName}',`order`={$order},`update_time`={$updateTime} WHERE id={$id} ";
//    echo $sql; return;
    //执行更新操作
    if (mysqli_query($conn, $sql)){
        echo '<script> alert("更新成功!");location.href="/index.php?act=cat_manage";</script>';
    } else {
        echo '<script> alert("更新失败");history.back();</script>';
    }
}

//删除分类表blog_category中记录
function do_cat_delete($table,$conn, $id)
{
    $sql = "DELETE FROM {$table} WHERE id={$id}";

    //执行删除操作
    if (mysqli_query($conn, $sql)){
        echo '<script> alert("删除成功!");location.href="/index.php?act=cat_manage";</script>';
    } else {
        echo '<script> alert("该分类下面还有数据,请清空后再删除~~");location.href="/index.php?act=cat_manage";</script>';
    }
}

/************************博文管理相关操作*************************/

//查询博文表blog_article中记录
function do_art_select($table , $conn, $where='', $order='', $limit='')
{
    $sql = 'SELECT * FROM '.$table.' '.$where.' '.$order.' '.$limit;
    $rows=[]; //创建结果返回的数组,返回二维关联数组
    if ($result = mysqli_query($conn, $sql)) {

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[]=$row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $rows;
}

//添加博文表blog_article中记录
function do_art_insert($table, $conn)
{
    $title = $_POST['title'];
    $order = $_POST['order'];
    $content = htmlspecialchars($_POST['content']);
    $catId = $_POST['cat_id'];
    $recommend = $_POST['recommend'];
    $titleUrl = '?cat='.$catId.'&id=';
     $createTime = time();
    $updateTime = time();

    $sql = "INSERT INTO {$table} VALUES (null,'{$title}',{$order},'{$content}',{$catId},{$recommend},'{$titleUrl}',{$createTime},{$updateTime})";

    //执行插入操作
    if (mysqli_query($conn, $sql)){
        $insert_id = mysqli_insert_id($conn);
        $updateUrl = "update {$table} set `title_url`='{$titleUrl}{$insert_id}' where `id`={$insert_id}";
        mysqli_query($conn,$updateUrl);
        echo '<script> alert("添加成功!");location.href="/index.php?act=art_manage";</script>';
    } else {
        echo '<script> alert("添加失败");location.href="/index.php?act=art_manage";</script>';
    }
}

//更新博文表blog_article中记录
function do_art_edit($table, $conn, $id)
{
    $title = $_POST['title'];
    $order = $_POST['order'];
    $content = htmlspecialchars($_POST['content']);
    $catId = $_POST['cat_id'];
    $recommend = $_POST['recommend'];
    $updateTime = time();
    //content字段必须加引号,因为是字符串
    $sql = "UPDATE {$table} SET `title`='{$title}',`order`={$order},`content`='{$content}',`cat_id`={$catId},`recommend`={$recommend},`update_time`={$updateTime} WHERE id={$id} ";

    //执行更新操作
    if (mysqli_query($conn, $sql)){
        echo '<script> alert("更新成功!");location.href="/index.php?act=art_manage";</script>';
    } else {
        echo '<script> alert("更新失败");location.href="/index.php?act=art_manage";</script>';
    }
}

//删除博文表blog_article中记录
function do_art_delete($table,$conn, $id)
{
    $sql = "DELETE FROM {$table} WHERE id={$id}";

    //执行删除操作
    if (mysqli_query($conn, $sql)){
        echo '<script> alert("删除成功!");location.href="/index.php?act=art_manage";</script>';
    } else {
        echo '<script> alert("删除失败");history.back();</script>';
    }
}

/************************用户管理相关操作*************************/

//查询用户数据
function do_user_select($table , $conn, $where='', $order='')
{
    $sql = 'SELECT * FROM '.$table.' '.$where.' '.$order;
    $rows=[]; //创建结果返回的数组,返回二维关联数组
    if ($result = mysqli_query($conn, $sql)) {

        while ($row = mysqli_fetch_assoc($result)) {
            $rows[]=$row;
        }
        mysqli_free_result($result);
    }
    mysqli_close($conn);

    return $rows;
}

//更新用户数据
function do_user_edit($table, $conn, $id)
{
    $userInfo = array_filter($_POST);  //过滤掉空值

    $updateStr = '';  //设置更新字段语句字符串的初值为空
    foreach ($userInfo as $key => $value){
        if ($key == 'password'){  //如果当前字段为密码,须经过md5加密
            $value = md5($value);
        }
        //注意字段名要加反撇符,后面要加一个逗号
        $updateStr .= "`{$key}`='{$value}', "; //生成字段更新语句部分
    }

    $updateTime = time(); //更新时间为当前时间戳

    $sql = "UPDATE {$table} SET {$updateStr} `update_time`={$updateTime} WHERE id={$id} ";

    //执行更新操作
    if (mysqli_query($conn, $sql)){
        echo '<script> alert("更新成功!");location.href="/index.php?act=user_manage";</script>';
    } else {
        echo '<script> alert("更新失败");history.back();</script>';
    }
}

/************************分页函数*************************/

/**
 * @param $conn :数据库连接资源
 * @param $table: 当前数据表名称
 * @param $page :当前页数$_GET['page']
 * @param $num :每页显示记录数量
 * @return SQL查询字符串: limit $offset, $num
 */
function pagination($conn, $table, $page, $num)
{
    /*
     * 1.对传入的当前页数$page进行特殊处理,第一页再向前默认设置为首页,已到尾页,再翻页必须是只能是最后一页
     * 所以必须先求出当前总页数,求总页数,必须要知道表中共有多少条记录,以及每页允许显示几条
     * 每页显示记录数是已知的,我们只要求出记录总数就是可以
     */

    //1-1:计算出当前表的记录数量
    $sql = "SELECT COUNT(*) AS count FROM `{$table}`";

    if ($result =mysqli_query($conn,$sql)){
        $row = mysqli_fetch_assoc($result);
        $count =  $row['count'];
    } else {
        echo '表中无数据~~';
        $count = 0;
    }


    //1-2.计算出总页数: 当前表记录数量/每页显示数量,再向上取整,注意,不是四舍五入
    $total = ceil($count / $num);

    //1-3.对当前页数$page进行处理
    $page = ($page <=1 ) ? 1 : $page; //如果当前已是第一页,返回1即首页,否则正常不改变
    $page = ($page >= $total) ? $total : $page; //如果已是尾页,则不再翻页,维持原值

    /**
     * 计算每页记录显示的起始序号,就是偏移量 = (当前页数 - 1) * 每页显示数量
     * 假设每页显示5条
     * 第1页: offset=(1-1)*5 = 0,limit 0, 5
     * 第3页: offset=(2-1)*5 = 0,limit 5, 5
     * 第3页: offset=(3-1)*5 = 0,limit 10, 5
     */

    $offset = ($page - 1) * $num;

    //拼接查询语句
    $limit = 'limit '.$offset.', '.$num;

    //将拼接好的分页查询条件返回
    return $limit;

}



//优化建议1:将分类管理与博文管理的数据库操作进行合并统一为标准的数据库操作接口,想一想,应该怎么做呢?
//优化建议2:将以上重复操作封装成类,然后对外提供统一的静态接口进行调用,又应该如何实现呢?