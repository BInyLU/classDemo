<?php  
//__FILE__ 获取当前文件所在路径
//dirname()  获取文件所在文件夹路径
//
//
//
//这个文件是从include中载入的
require_once dirname(__FILE__).'/../../functions.php';
$current_page= isset( $current_page) ? $current_page:' ' ;


// session_start();
// $current_user=$_SESSION['current_login_user'];
$current_user=baixiu_get_current_user();





?>
<!-- 这里的$current_page变量是为了解决侧边栏高亮问题 -->
<div class="aside">
    <div class="profile">
      <img class="avatar" src="<?php echo $current_user['avatar']; ?>">
      <h3 class="name"><?php echo $current_user['nickname']; ?></h3>
    </div>
    <ul class="nav">
      <li <?php echo $current_page==='user' ? 'class="active"':' ' ?>>
        <a href="user.php"><i class="fa fa-dashboard"></i>仪表盘</a>
      </li>
      <?php $menu_posts = array('posts','categories','post-add'); ?>
      <li <?php echo in_array($current_page,$menu_posts) ? 'class="active"':' ' ?>>
        <a href="#menu-posts" class="<?php echo in_array($current_page,$menu_posts) ? '""':'collapsed' ?>" data-toggle="collapse">
          <i class="fa fa-thumb-tack"></i>文章<i class="fa fa-angle-right"></i>
        </a>
        <ul id="menu-posts" class="collapse<?php echo in_array($current_page,$menu_posts) ? ' in':' ' ?>">
          <li <?php echo $current_page==='post-add' ? 'class="active"':' ' ?>><a href="post-add2.php">写文章</a></li>
        </ul>
      </li>
    </ul>
  </div>