<?php 
require_once '../functions.php';
//根据客户端传递过来的ID删除对应数据
//
if (empty($_GET['id'])) {
	exit('缺少必要参数');
}
$id=$_GET['id'];

$rows=SqlOperation('delete from posts where id in (' . $id . ');');
$row_s=SqlOperation('delete from comments where post_id in (' . $id . ');');


header('Location: posts.php');
// if ($rows>0) {
// 	# code...
// }



