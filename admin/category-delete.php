<?php 
require_once '../functions.php';
//根据客户端传递过来的ID删除对应数据
//
if (empty($_GET['id'])) {
	exit('缺少必要参数');
}
$id=$_GET['id'];

$rows=SqlOperation('delete from categories where id in (' . $id . ');');
$row_s=SqlOperation('delete from posts where category_id in (' . $id . ');');

header('Location: categories.php');
// if ($rows>0) {
// 	# code...
// }



